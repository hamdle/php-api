<?php
namespace Database;

class Query implements QueryInterface
{
    public function run($query)
    {
        return MySQL::run($query);
    }

    public function filter_by($args, $table)
    {
        $query = $this->buildFilterBy($args, $table);
        return MySQL::run($query);
    }

    public function get($id, $table)
    {
        $query = "select * from {$table} where id = {$id}";
        return MySQL::run($query);
    }

    public function add($args, $table)
    {
        $query = "insert into {$table} (";
        $values = "";

        foreach ($args as $key => $value) {
            $query .= "`{$key}`,"; 
            $values .= "'{$value}',";
        }
        $query = substr($query, 0, -1);
        $values = substr($values, 0, -1);

        $query .= ") values ({$values})";

        return MySQL::run($query);
    }

    public function update($args, $table)
    {
        // TODO
    }

    private function buildFilterBy($args, $table)
    {
        $query = "select * from {$table}";

        if (count($args) > 0) {
            $query .= " where";
        }

        $count = 1;
        foreach ($args as $key => $value) {
            if (count($args) === 1) {
                $query .= " `{$key}` = '{$value}'";
            } else if ($count < count($args)) {
                $query .= " `{$key}` = '{$value}' and";
            } else {
                $query .= " `{$key}` = '{$value}'";
            }
            $count++;
        }
        \Utils\ErrorLog::print($query);


        return $query;
    }
}
