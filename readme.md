# wo API

This is a web application to track my workouts, herby dubbed wo.

There are three parts to the wo project (1) the app, (2) the API, and (3) the deploy.

This is (2) the API. The API is the data application programming interface of wo. It processes, saves, and sends the workout data.

The workout API accepts data sent from the app and is deployed by a custom-built auto deploy application.

# API

This API communicates in JSON.

## GET

### /wo/api/{user_id}/program

#### Response

```
{
    "program_id": "66",
    "length": "6",
    "program": [
        {
            "program_id": "0",
            "exercise_id": "3",
            "title": "Pull Ups",
            "reps": {
                "length": 2,
                "default_amount": 5,
                "last_amount": 7,
                "rec_amount": 8
            }
        },
        ...
    ]
}
```

## POST

### /wo/api/authenticate

#### Request

```
{
    "pub_key": "key_value",
}
```

#### Response

Success

```
{
    "user_id": "22"
}
```

Failure

```
{
    "status": "fail",
    "message": "Failure message."
}
```

### /wo/api/{user_id}/start

Start a new workout.

#### Request

The program sent should be the response from **/wo/api/{user_id}/program**.

```
{
    "timestamp": "2019-02-15 12:00:00",
    "program": [
        ...
    ]
}
```

#### Response

```
{
    "status": "ok",
    "workout_id": "22"
}
```

### /wo/api/{user_id}/update

Use this to update a workout as it's happening or to correct old workout data.

#### Request

```
{
    "workout_id": "22",
    "exercise": [
        {
            "exercise_id": "3",
            "title": "Chin Ups",
            "length": "2",
            "reps": [
                "6",
                "6"
            ]
        },
        {
            "exercise_id": "0",
            "title": "Push Ups",
            "length": "3",
            "reps": [
                "5",
                "5",
                "5"
            ]
        }
    ]
}
```

#### Response

{
    "status": "ok"
}

### /wo/api/{user_id}/finish

```
{
        "timestamp": "",
        "notes": "Workout notes."
}
```

