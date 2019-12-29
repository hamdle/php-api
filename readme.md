# wo API

This is a web application to track my workouts, herby dubbed wo.

There are three parts to the wo project (1) the app, (2) the API, and (3) the deploy.

This is (2) the API. The API is the data application programming interface of wo. It processes, saves, and sends the workout data.

The workout API accepts data sent from the app and is deployed by a custom-built auto deploy application.

# Nginx setup

All API request should be rounted through `/wo/api/index.php`. To achieve this, place the following in your nginx config file.

```
location /wo/api {
    try_files $uri $uri/ /wo/api/index.php?query_string;
}
```

# API

This API communicates in JSON and attepts to respond in a RESTful way.

### Status codes

Code | Message
---- | -------
200  | GET, PUT, or PATCH OK
201  | POST OK
204  | DELETE OK
400  | Bad request
401  | Unauthorized user
403  | Forbidden resource
404  | Not found

### Failed response message

A failed status code will attept to return a message.

```
{
    "message": "User not found."
}
```

## GET

### /wo/api/{userId}/program

#### Response

Success code: 200

```
{
    "programId": "66",
    "length": "6",
    "program": [
        {
            "programId": "0",
            "exerciseId": "3",
            "title": "Pull Ups",
            "details": {
                "sets": 2,
                "defaultReps": 5,
                "lastReps": 7,
                "recommendedReps": 8
            }
        },
        ...
    ]
}
```

### /wo/api/authenticate

Authenticate user.

#### Request

```
{
    "email": "admin@localhost",
    "password": "password"
}
```

#### Response

Success code: 200

```
{
    "user_id": "22"
    // TODO
}
```

## POST

### /wo/api/{userId}/start

Start a new workout.

#### Request

The `program` data sent should be from the `/wo/api/{userId}/program` GET request.

```
{
    "timestamp": "2019-02-15 12:00:00",
    "program": [
        ...
    ]
}
```

#### Response

Success code: 201

## PATCH

### /wo/api/{user_id}/update

Use this to update a workout as it's happening or to correct existing workout data.

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

Success code: 200

### /wo/api/{userId}/complete


#### Request

```
{
        "timestamp": "",
        "notes": "Workout notes."
}
```

#### Response

Success code: 200

