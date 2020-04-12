<?php
namespace Controllers;

use Http\Response;
use Database\Query\Users;
use Database\Query\Workouts;
use Database\Query\Reps;
use Database\Query\Sessions;
use Database\Query\Entries;

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
        return $response->send(Response::HTTP_200_OK, $data);
    }

    public function post($args = [])
    {
        $sessions = new Sessions();
        
        if ($sessions->verify() == true) {
            $workouts = new Workouts();
            $workouts->add($workouts->filter_args($args['data']));

            $entries = new Entries();
            $reps = new Reps();
            for ($index = 0; $index < count($args['data']['entries']); $index++) {
                $entries->add($entries->filter_args($args['data']['entries'][$index]));
                $reps->add($reps->filter_args($args['data']['entries'][$index]['reps']));
            }

            $response = new Response();
            return $response->send(Response::HTTP_200_OK);
        }

        $response = new Response();
        return $response->send(Response::HTTP_401_UNAUTHORIZED);
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
