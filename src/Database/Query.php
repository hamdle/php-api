<?php
namespace Database;

class Query implements QueryInterface
{
    public function run($query)
    {
        return MySQL::run($query);
    }

    public function filter_by($table, $args)
    {
        // TODO
    }

    public function get($table, $args)
    {
        // TODO
    }

    public function set($table, $args)
    {
        // TODO
    }

    public function add($table, $args)
    {
        // TODO
    }

    public function update($table, $args)
    {
        // TODO
    }

    public function replace($table, $args)
    {
        // TODO
    }
}
