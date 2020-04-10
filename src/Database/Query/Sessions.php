<?php
namespace Database\Query;

use Database\Query;
use Models\Session;

class Sessions extends Query
{
    protected const SESSIONS_TABLE = 'sessions';

    public function filter_by($user_id, $table = self::SESSIONS_TABLE)
    {
        $queryResults = parent::filter_by(['user_id' => $user_id], $table);
        if ($queryResults == null) {
            return null;
        }
        return new Session($queryResults[0]);
    }

    public function save($user_id, $key, $value) {
        $args = [
            'user_id' => $user_id,
            'key' => $key,
            'value' => $value
        ];

        parent::add($args, self::SESSIONS_TABLE); 
    }
}
