<?php

/*
 * Http/Code.php: http response codes
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Http;

class Code
{
    /*
     * Http status codes.
     * @vars numeric
     */
    const HTTP_200_OK = 200;
    const HTTP_201_CREATED = 201;
    const HTTP_204_DELETED = 204;
    const HTTP_400_BAD_REQUEST = 400;
    const HTTP_401_UNAUTHORIZED = 401;
    const HTTP_403_FORBIDDEN = 403;
    const HTTP_404_NOT_FOUND = 404;
    const HTTP_422_UNPROCESSABLE_ENTITY = 422;
    const HTTP_500_INTERNAL_SERVER_ERROR = 500;
}
