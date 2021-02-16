# workout API

This is one component of a larger web application that I use to track my workouts.

The key tenets of this codebase are speed and simplicity. Every object that is instantiated, is used. Controllers that are never used, are never put in memory. No architechtures and patterns are only used when necessary.

# Nginx setup

To route the API through the URI, like `workout.dev/api`, place the following in the nginx config.

```
location /workout/api {
    try_files $uri $uri/ /workout/api/index.php?query_string;
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

Authenticate a user login request by returning a seccess or failure code.

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

