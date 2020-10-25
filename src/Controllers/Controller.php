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
        $this->args = $args;
    }

    // Send a JSON Response from a Controller.
    public function sendResponse()
    {
        $class = __NAMESPACE__."\\".$this->class;
        $method = $this->method;

        $controller = new $class();
        $controller->$method($this->args);
    }
}
