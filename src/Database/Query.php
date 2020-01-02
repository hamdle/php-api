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
        // TODO
    }

    public function update($args, $table)
    {
        // TODO
    }

    private function buildFilterBy($args, $table)
    {
        $query = "select * from {$table}";
        // TODO Add where clause to filter by $args.
        return $query;
    }
}
