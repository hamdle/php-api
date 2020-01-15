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

    public function filter_by($id, $table = SELF::USER_TABLE)
    {
        $queryResults = parent::filter_by($id, $table);
        $user = new User($queryResults[0]);
        return $user;
    }
}
