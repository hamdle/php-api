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

## Programs

Programs define a single workout routine. A program is a collection of the exercises, the order to perform the exercises, the number of sets for each exercise, and number of reps for each set.

### GET /{userId}/programs/new

Create a new program for the next workout. This will generate recommendations based on previous workouts.

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

### GET /{userId}/programs/new/shuffle

This will generate a program using `/{userId}/programs/new` but perform a second step and shuffle the exercises in an appropriate way.

#### TODO

1. GET `/{userId}/programs`
2. GET `/{userId}/programs/{programId}`

## Workouts

### POST /{userId}/workouts

Create a new workout. The workout data can be incomplete and filled in via PATCH later.

#### Request

The `program` data sent should be from the `/{userId}/program` GET request.

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

### PATCH /{userId}/workouts

Use this to update a workout as it's happening or to correct existing workout data.

#### Request

```
{
    "workoutId": "22",
    "timestamp": "1970-01-01 23:00:00",
    "notes": "Workout notes."
    "exercise": [
        {
            "exerciseId": "3",
            "title": "Chin Ups",
            "length": "2",
            "reps": [
                "6",
                "6"
            ]
        },
        {
            "exerciseId": "0",
            "title": "Push Ups",
            "length": "3",
            "reps": [
                "5",
                "5",
                "5"
            ]
        },
        ...
    ]
}
```

#### Response

Success code: 200

#### TODO

1. PUT `/{userId}/workouts/{workoutId}`
2. GET `/{userId}/workouts`
2. GET `/{userId}/workouts/{workoutId}`

## User

### POST /logout

Log user out of application.

#### Request

```
{
    "token": "token"
}
```

#### Response

Success code: 200

### GET /user

Get logged in user info.

#### Request

```
{
    "token": "token"
}
```

#### Response

Success code: 200

### POST /authenticate

Authenticate user.

#### Request

```
{
    "email": "admin@localhost",
    "password": "password"
}
```

#### Response

Success code: 201

```
{
    "userId": "22",
    "token": "token"
}
```

