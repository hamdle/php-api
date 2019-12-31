<?php
namespace Http;

use Controllers\Controller;
use Http\Response;
use Utils\ErrorLog;

class Api
{
    private $endpoints;

    public function run()
    {
        $request = Request::get();
        $controller = $this->getController($request);

        $controller->response();
    }

    public function endpoint($uri, $controller) 
    {
        $this->endpoints[$uri] = $controller;
    }

    private function getController($request)
    {
        // TODO (2) make it better.
        $endpoints = $this->quickFilterEndpoints($request);
        ErrorLog::print($endpoints, 'ENDPOINTS###');
        if (empty($endpoints))
        {
            return new Controller('ErrorController', 'get');
        }

        $requestParts = $request->getPathParts();
        $match = true;
        $uriArgs = [];
        foreach ($endpoints as $key => $value)
        {
            $match = true;
            $uriArgs = [];
            $keyParts = explode('/', $key);

            for ($n = 0; $n < count($requestParts); $n++)
            {
                if ($requestParts[$n] == $keyParts[$n])
                {
                    continue;
                }
                if (intval($requestParts[$n]) === 0)
                {
                    $match = false;
                }
                else
                {
                    $argKey = str_replace(['{', '}'], '', $keyParts[$n]);
                    $uriArgs[$argKey] = intval($requestParts[$n]);
                }
            }
            if ($match)
            {
                $parts = explode('.', $value);
                $class= $parts[0];
                $method = $parts[1];

                return new Controller($class, $method, $uriArgs);
            }
        }

        return new Controller('ErrorController', 'get');
    }

    // Return endpoints with the same number of parts and method
    // as the request
    // @return [$key => $value]
    private function quickFilterEndpoints($request)
    {
        $filteredEndpoints = [];
        $requestParts = $request->getPathParts();

        foreach ($this->endpoints as $uri => $controller) {
            $uriParts = explode('/', $uri);

            $controllerParts = explode('.', $controller);
            $class = $controllerParts[0];
            $method = $controllerParts[1];

            // URI parts length match
            if (count($requestParts) === count($uriParts))
            {
                // Request method match
                if ($method == strtolower($request->getMethod()))
                {
                    $filteredEndpoints[$uri] = $controller;
                }
            }
        }

        return $filteredEndpoints;
    }
}
