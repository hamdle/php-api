<?php

/*
 * Database/MySQL.php: interface with MySQL database
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Database;

use mysqli;

class MySQL
{
    /*
     * Static connection to MySQL database.
     *
     * @var mysqli connection object
     */
    protected static $mysql = null;

    /*
     * Get or create connection to MySQL database.
     *
     * @return mysqli connection object
     */
    protected static function connect()
    {
        if (is_null(self::$mysql))
        {
            self::$mysql = new mysqli(
                $_ENV['DB_HOST'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                $_ENV['DB_NAME']
            );

            if (self::$mysql->connect_errno)
            {
                print 'Database connection failed.';
                exit;
            }
        }

        return self::$mysql;
    }

    /*
     * Run a sql query using OO version of mysqli.
     *
     * @param $query - a complete SQL query
     * @return $rows[] | $id | null
     */
    public static function run($query)
    {
        $db = self::connect();

        $rows = [];
        if ($results = $db->query($query))
        {
            if (is_bool($results))
            {
                if ($results)
                    return $db->insert_id;

                return null;
            }
            if ($db->error)
            {
                \Utils\Logger::info($db->error, 'database error');
                return null;
            }
            while ($row = $results->fetch_assoc())
            {
                $rows[] = $row;
            }

            $results->free();
        }

        return $rows;
    }

    /*
     * Close MySQL connection.
     *
     * @return void
     */
    public static function close()
    {
        if (!is_null(self::$mysql))
        {
            self::$mysql->close();
        }
    }
}
