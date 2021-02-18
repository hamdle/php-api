# Workout API

The Workout API is designed to track workouts that I've been using, and logging, and losing, for the past few years. The API manages the data and users to log workouts in an effort to best my old pen and paper logging system. There's an accompanying web application that manages all of the user facing interactions --- logging in the user, logging the workouts, rendering cool charts --- that works in collaboration with the API.

The execution stack of the API is intended to be clean and easy to follow. There are a few ethos that have contributed to the design of this programm. If a function is static, it will almost always be called in the excution tree of every request. Objects like Controllers and Models are not loaded into memeory until they have something to contribute or execute. I try to use design patterns to lower complexity not add to it. And arrays are a powerful tool that are wholly capable of modeling data, for the program and the programmers mental model of the program, so they are used as a central part of the API.

# Nginx setup

To route the API through the URI, like `workout.dev/api`, place the following in the nginx config.

```
location /api {
    try_files $uri $uri/ /api/index.php?query_string;
}
```

# API

This API communicates in JSON and attepts to respond in a RESTful way.

### Status codes

Code | Message
---- | -------
200  | GET, PUT, or PATCH Success
201  | POST Success
204  | DELETE Success
400  | Bad request
401  | Unauthorized
403  | Forbidden
404  | Not found

### POST /login

Authenticate a user login request by returning a success or failure code.

#### Request

```
{
    'user': 'admin@localhost.com',
    'password': 'password123'
}
```

#### Response

Success code: 200

Failure code: 403

### GET /auth

Verify that a cookie is valid and matches the user creds.

#### Request

No extra data needed. In browsers, the cookie will be send automatically.

#### Response

Success code: 200

Failure code: 401


### GET /exercises

Return a list of all exercises and their default values.

#### Request

No extra data needed.

#### Response

Success code: 200

### GET /version

Return the current version of the API. Good for a quick ping to make sure everything is okay.

#### Request

No extra data needed.

#### Response

Success code: 200

### POST /workouts/new

Add a new workout that a user has completed.

#### Request

```
{
    'start': null,
    'end': null,
    'notes': null,
    'feel': null,
    'entries': [
        {
            'exercises_id': null,
            'sets': null,
            'reps': [
                {
                    'amount': null
                },
                {
                    'amount': null
                },
            ],
            'feedback': null
        },
        {
            'exercises_id': null,
            'sets': null,
            'reps': [
                {
                    'amount': null
                },
                {
                    'amount': null
                },
            ],
            'feedback': null
        },
        ...
    ]
}
```

#### Response

Success code: 200

Failure code: 400

