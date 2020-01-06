<?php
namespace Controllers;

use Http\Response;
use Database\Query\Users;
use Database\Query\Workouts;

class WorkoutController implements ControllerInterface
{
    public function get($args = [])
    {
        $users = new Users();
        $user = $users->get(1);

        $workouts = new Workouts();
        $workout = $workouts->new(1);

        $data = [
            'user' => $user->email,
            'workout_html' => $workout->html()
        ];

        $response = new Response();
        $response->send(Response::HTTP_200_OK, $data);
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
