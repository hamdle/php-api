<?php
namespace Database;

use mysqli;

class MySQL
{
    protected $mysqli;

    public function connect()
    {
        $this->mysqli = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_NAME']
        );

        if ($this->mysqli->connect_errno)
        {
            echo 'Database connection failed.';
            die();
        }
    }

    public function query()
    {
        $query = "select email from users";

        if ($results = $this->mysqli->query($query))
        {
            while ($row = $results->fetch_assoc())
            {
                \Utils\ErrorLog::print($row);
            }

            $results->free();
        }
    }

    public function close()
    {
        $this->mysqli->close();
    }
}
