<?php
namespace Http;

class Request {
    private static $instance;

    public static function get()
    {
        if (isset(self::$instance))
        {
            return self::$instance;
        }
        else
        {
            self::$instance = new Request();
            return self::$instance;
        }
    }

    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getPathParts()
    {
        // TODO Make this better. Use a for loop and in_array to filter out the items.
        $parts = explode('/', $this->getPath());

        // Remove uri elements that are not part of the API request.
        $filter = array_filter(
            $parts,
            function($item)
            {
                if (empty(trim($item)))
                {
                    return 0;
                }
                // TODO Make this use a static array of uri elements to be removed.
                if ($item == 'api')
                {
                    return 0;
                }

                return 1;
            }
        );

        // Re-index the array to start at index 0
        $reindexed = [];
        foreach ($filter as $part)
        {
            $reindexed[] = $part;
        }

        return $reindexed;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function getPost()
    {
        return $_POST;
    }
}
