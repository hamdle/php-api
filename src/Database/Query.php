<?php

/*
 * Database/Query.php: run database queries
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Database;

use mysqli;

class Query
{
    /*
     * Static connection to MySQL database.
     * @var mysqli connection object
     */
    protected static $mysql = null;

    /*
     * Get or create connection to MySQL database.
     * @return mysqli connection object
     */
    public static function connection()
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
     * @return void
     */
    public static function close()
    {
        if (!is_null(self::$mysql))
            self::$mysql->close();
    }

    /*
     * Run an insert query.
     * @param $query - a complete SQL query
     * @return see Database\Query::run()
     */
    public static function insert($query)
    {
        return self::run($query);
    }

    public static function delete($table, $where = null)
    {
        $query = "delete from ".$table;

        if (is_array($where))
        {
            $query .= " where ";

            $count = 0;
            foreach ($where as $key => $attribute)
            {
                $count++;
                if (!is_array($attribute))
                {
                    $query .= $key . " = '" . mysqli_real_escape_string(self::connection(), $attribute) . "'";
                    if (count($where) !== $count)
                        $query .= " and ";
                }
            }
        }

        return self::run($query);
    }

    /*
     * Run a select query.
     * @return see Database\Query::run()
     */
    public static function select($table, $selects, $where = null)
    {
        $query = "select ";

        if ($selects == '*')
            $query .= $selects;
        else if (is_array($selects))
            $query .= implode(",", $selects);

        $query .= " from ".$table;

        if (is_array($where))
        {
            $query .= " where ";

            $count = 0;
            foreach ($where as $key => $attribute)
            {
                $count++;
                if (!is_array($attribute))
                {
                    $query .= $key . " = '" . mysqli_real_escape_string(self::connection(), $attribute) . "'";
                    if (count($where) !== $count)
                        $query .= " and ";
                }
            }
        }

        return self::run($query);
    }

    /*
     * Run a sql query using OO version of mysqli.
     * @param $query - a complete SQL query
     * @return $rows[] | $id | null
     */
    public static function run($query)
    {
        $db = self::connection();
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
                \Utils\Logger::error($db->error, 'A database error has occured.');
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
    public function execute($args, $table)
    {
        $query = $this->buildFilterBy($args, $table);
        return $this->run($query);
    }

    public function get($id, $table)
    {
        $query = "select * from {$table} where id = {$id}";
        return $this->run($query);
    }

    public function add($args, $table)
    {
        $query = "insert into {$table} (";
        $values = "";

        foreach ($args as $key => $value)
        {
            $query .= "`{$key}`,"; 
            $values .= "'{$value}',";
        }
        $query = substr($query, 0, -1);
        $values = substr($values, 0, -1);
        $query .= ") values ({$values})";

        return $this->run($query);
    }

    private function buildFilterBy($args, $table)
    {
        $query = "select * from {$table}";

        if (count($args) > 0)
            $query .= " where";

        $count = 1;
        foreach ($args as $key => $value)
        {
            if (count($args) === 1)
                $query .= " `{$key}` = '{$value}'";
            else if ($count < count($args))
                $query .= " `{$key}` = '{$value}' and";
            else
                $query .= " `{$key}` = '{$value}'";

            $count++;
        }

        return $query;
    }
     */
}
