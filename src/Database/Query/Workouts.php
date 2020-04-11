<?php
namespace Database\Query;

use Database\Query;
use Database\Query\Exercises;
use Models\Workout;

class Workouts extends Query
{
    protected const WORKOUT_TABLE = 'workouts';

    public function new($user_id)
    {
        $exercises = new Exercises();
        $allExercises = $exercises->all();
        \Utils\ErrorLog::print($allExercises);

        $sampleWorkout = [
            'id' => -1,
            'user_id' => $user_id,
            'start' => null,
            'end' => null,
            'notes' => null,
            'feel' => null
        ];
        $workout = new Workout($sampleWorkout);
        // TODO Get previous workout and return that as a Workout.

        return $workout;
    }

    public function add($args, $table = self::WORKOUT_TABLE)
    {
        parent::add($args, $table);
    }
}
