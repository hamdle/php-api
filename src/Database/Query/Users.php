<?php
namespace Database\Query;

use Database\Query;
use Models\User;

class Users extends Query
{
    protected const USER_TABLE = 'users';

    /**
     * Return a single User object from an id.
     * @param $id - a user id
     * @return \Models\User
     */
    public function get($id, $table = self::USER_TABLE)
    {
        $queryResults = parent::get($id, $table);
        $user = new User($queryResults[0]);
        return $user;
    }

    /** 
     * Query the users table, return a User object or null.
     * @param map is a key, value array.
     * @return \Models\User
     */
    public function filter_by($map, $table = SELF::USER_TABLE)
    {
        $queryResults = parent::filter_by($map, $table);
        if ($queryResults == null) {
            return null;
        }
        return new User($queryResults[0]);
    }
}
