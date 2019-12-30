<?php
namespace Http;

class Response
{
    // Content type
    const JSON_CONTENT_TYPE = 'Content-Type: application/json';

    // Http status codes
    const HTTP_200_OK = 200;
    const HTTP_201_CREATED = 201;
    const HTTP_204_DELETED = 204;
    const HTTP_400_BAD_REQUEST = 400;
    const HTTP_401_UNAUTHORIZED = 401;
    const HTTP_403_FORBIDDEN = 403;
    const HTTP_404_NOT_FOUND = 404;

    public function send($code, $data)
    {
        header(self::JSON_CONTENT_TYPE);
        http_response_code($code);
        echo json_encode($data);
    }
}
