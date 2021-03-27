<?php

/*
 * Models/Session.php: a user session
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Models;

use Http\Request;
use Http\Response;
use Database\Query;

class Session
{
    use \Traits\Attributes;
    use \Traits\AttributeActions;
    use \Traits\Messages;

    /*
     * The Session attributes defined in the database are:
     *
     * id
     * user_id
     * key
     * value
     */

    protected const SESSIONS_TABLE = 'sessions';
    const COOKIE_KEY = 'Session-Id';

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /*
     * Attempt to load a session using the attributes assigned to this session.
     * @return bool - a message will be set if the session fails to load
     */
    public function load()
    {
        $this->filter($this->config());
        $this->transform($this->transforms());

        $results = Query::select(self::SESSIONS_TABLE, "*", $this->attributes);

        if (array_key_exists(0, $results))
        {
            foreach ($results[0] as $key => $value)
            {
                $this->attributes[$key] = $value;
            }
        }
        else
        {
            $this->messages[] = "Session not found.";
            return false;
        }

        return true;
    }

    /*
     * Save this token to the database.
     */
    public function save()
    {
        Query::insert(
            self::SESSIONS_TABLE,
            ["user_id", "token"],
            [$this->user_id, $this->token]);
    }

    /*
     * Delete this token to the database.
     */
    public function delete()
    {
        Query::delete(self::SESSIONS_TABLE, ['id' => $this->id]);
    }

    /*
     * Create a new cookie for a user.
     * @param \Models\User
     */
    public function createNewCookie($user)
    {
        $token = bin2hex(random_bytes(128));
        $cookie = $user->email.":".$token;
        $mac = hash_hmac('sha256', $cookie, $_ENV['COOKIE_KEY']);
        $cookie .= ":".$mac;

        $this->user_id = $user->id;
        $this->token = $token;
        $this->save();

        $this->cookie = $cookie;
    }

    /*
     * Add cookie to response that's attached to this session object.
     */
    public function addCookie()
    {
        Response::addCookie([self::COOKIE_KEY => $this->cookie]);
    }

    /*
     * Verify that a cookie sent from the client is valid. If the cookie is
     * valid, the verified user (of type \Models\User) will be added to the
     * session's attributes.
     * @return bool
     */
    public function verify()
    {
        foreach (Request::cookie() as $key => $value) {
            if (strcmp($key, self::COOKIE_KEY) !== 0)
                continue;

            $parts = explode(":", $value);
            if (count($parts) !== 3)
                return false;

            $user = new User(['email' => $parts[0]]);
            if (!$user->load())
                return false;

            $this->user_id = $user->id;
            if (!$this->load())
            {
                $this->setExpiredCookie();
                return false;
            }
            $this->user = $user;

            // The final cookie value will be in the form of "email:token:mac".
            // Where the email and token combine with a key from the .env to
            // create the mac.
            $this->cookie = $user->email.":".$this->token;
            $mac = hash_hmac('sha256', $this->cookie, $_ENV['COOKIE_KEY']);

            if (hash_equals($mac, $parts[2]))
                return true;
        }

        return false;
    }

    /*
     * Delete a cookie on the client by setting it as expired.
     */
    public function setExpiredCookie()
    {
        Response::addExpiredCookie([self::COOKIE_KEY => $this->cookie]);
    }


    public function config()
    {
        return [
            'user_id' => function ($entry) {
                if (empty($entry))
                    return "User ID should not be empty.";
                return true;
            },
            'token' => function ($entry) {
                if (empty($entry))
                    return "Token should not be empty.";
                return true;
            },
        ];
    }

    public function transforms()
    {
        return [
            'user_id' => function ($entry) {
                return $entry;
            },
            'token' => function ($entry) {
                return $entry;
            },
        ];
    }
}
