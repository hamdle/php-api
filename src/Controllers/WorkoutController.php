<?php
namespace Controllers;

use Http\Response;
use Database\Query\Users;
use Database\Query\Workouts;
use Database\Query\Exercises;
use Database\Query\Sessions;

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
        // TODO: Save workout and exercise data.
        $sessions = new Sessions();
        
        if ($sessions->verify() == true) {
            $workouts = new Workouts();
            $workoutArgs = [];
            //$workouts->add($workoutArgs);

            $exercises = new Exercises();
            $exerciseArgs = [];
            foreach ($exerciseArgs as $exercise) {
               //$exercises->add($exercise); 
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
