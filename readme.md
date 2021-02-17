# Workout API

This API is designed to track a workout program, not computer program, that I've been developing over the past few years. The workout program is based on my experice learning and trying out calisthenics workouts, so the exercises are geared towards individual workouts with limited equipment. I've built an accompanying web application, which is a computer program, that communicates with this API, also a computer program. I originally tracked workouts in .txt files which was robust but difficult to get more functionality out of. The web app and API solve this problem and allows for slightly more sophistication than managing workouts on paper. Auto suggesting reps, one-click workout generation, automatically time tracking, and charting workouts are a few of the nice features made possible by using this API and web app together.

The execution stack should be clean and easy to follow. If a function is static, there's a good chance it will be called in the excution tree of every request. Objects, like Controllers and Models, are not loaded into memeory until they need to be executed. Design patterns are only used to lower complexity, not add to it. Array structures are a good way to model data for web applications and I try to use them as often as I can.

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

