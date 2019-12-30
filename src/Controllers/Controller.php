<?php
namespace Controllers;

class Controller
{
    private $class;
    private $method;
    private $args;

    public function __construct($class, $method, $args = [])
    {
        $this->class = $class;
        $this->method = $method;
    }

    public function respond()
    {
        $class = __NAMESPACE__."\\".$this->class;
        $method = $this->method;

        $controller = new $class();
        $controller->$method($this->args);
    }
}
