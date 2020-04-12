<?php
namespace Database\Query;

use Http\Request;
use Database\Query;
use Models\Session;

class Sessions extends Query
{
    protected const SESSIONS_TABLE = 'sessions';

    public function filter_by($filters, $table = self::SESSIONS_TABLE)
    {
        $queryResults = parent::filter_by($filters, $table);
        if ($queryResults == null) {
            return null;
        }
        return new Session($queryResults[0]);
    }

    public function save($user_id, $key, $value)
    {
        $args = [
            'user_id' => $user_id,
            'key' => $key,
            'value' => $value
        ];

        parent::add($args, self::SESSIONS_TABLE);
    }

    /**
     * Check to make sure a cookie sent from the client is valid.
     * @params $cookie - ['key' => 'value']
     * @return false or \Models\User
     */
    public function verify($cookie = null)
    {
        if ($cookie == null) {
            $request = new Request();
            $cookie = $request->getCookie();
        }

        if (count($cookie) > 1) {
            return false;
        }

        $cookieArgs = [];
        foreach ($cookie as $key => $value) {
            $cookieArgs = [
                'key' => $key,
                'value' => $value
            ]; 
        }

        $session = $this->filter_by($cookieArgs, self::SESSIONS_TABLE);

        if ($session == null) {
            return false;
        }

        $users = new Users();
        $user = $users->filter_by(['id' => $session->user_id]);

        if ($user == null) {
            return false;
        }

        if (strcmp($session->value, md5($user->email.$_ENV['COOKIE_NOISE'])) == 0) {
            return $user;
        }

        return false;
    }
}
