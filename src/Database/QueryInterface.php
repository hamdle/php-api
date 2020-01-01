<?php
namespace Database;

interface QueryInterface
{
    public function run($query);
    /* $args can be a key, value pair or a Model class instance */
    public function filter_by($subject, $args);
    public function get($table, $args);
    public function set($table, $args);
    public function add($table, $args);
    public function update($table, $args);
    public function replace($table, $args);
}
