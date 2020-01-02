<?php
namespace Database\Query;

use Database\Query;
use Models\User;

class Users extends Query
{
    protected const USER_TABLE = 'users';

    // @return \Models\User
    public function get($id, $table = self::USER_TABLE)
    {
        $queryResults = parent::get($id, $table);
        $user = new User($queryResults[0]);
        return $user;
    }
}
