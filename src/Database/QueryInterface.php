<?php
namespace Database;

interface QueryInterface
{
    public function sql();
    public function filter_by();
}
