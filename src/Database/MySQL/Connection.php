<?php

/*
 * Database/MySQL/Connection.php: connect to MySQL database
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Database\MySQL;

use mysqli;

class Connection
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
    public static function mysql()
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
