<?php
namespace Controllers;

use Http\Response;
use Database\Query\Exercises;

class ExerciseController implements ControllerInterface
{
    public function get($args = [])
    {
        $exercises = new Exercises();
        $all = $exercises->all();

        $response = new Response();
        $response->send(Response::HTTP_200_OK, $all);
    }

    public function post($args = [])
    {
        // TODO
    }

    public function put($args = [])
    {
        // TODO
    }

    public function patch($args = [])
    {
        // TODO
    }

    public function delete($args = [])
    {
        // TODO
    }
}
