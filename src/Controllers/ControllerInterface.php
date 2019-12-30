<?php
namespace Controllers;

interface ControllerInterface
{
    public function get($args);
    public function post($args);
    public function put($args);
    public function patch($args);
    public function delete($args);
}
