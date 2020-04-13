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
200  | GET, PUT, or PATCH Success
201  | POST Success
204  | DELETE Success
400  | Bad request
401  | Unauthorized
403  | Forbidden
404  | Not found

### POST /login

Authenticate a user login request.

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


### GET /exercises

Return a list of all exercises and their default values.

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
                'amount': null
            ],
            'feedback': null
        },
        {
            'exercises_id': null,
            'sets': null,
            'reps': [
                'amount': null
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

