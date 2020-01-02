<?php
namespace Database;

interface QueryInterface
{
    public function run($query);
    /* $args can be a key, value pair or a Model class instance */
    public function filter_by($args, $table);
    public function get($id, $table);
    public function add($args, $table);
    public function update($args, $table);
}
