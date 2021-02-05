<?php

/*
 * Utils/Env.php: read .env, make global $_ENV
 *
 * Copyright (C) 2021 Eric Marty
 */

namespace Utils;

use Exception;

class Env
{
    /*
     * Location of .env file.
     *
     * @return string
     */
    protected $envPath;

    public function __construct()
    {
        $this->envPath = $_SERVER["DOCUMENT_ROOT"] . '/.env';
    }

    /*
     * Load .env file.
     *
     * @return void
     */
    public function load()
    {
        try {
            $output = file_get_contents($this->envPath);

            if ($output === false || $output == '')
                throw new Exception();
        } catch (Exception $e) {
            echo "No file found. Create .env or update permissions.";
            exit();
        }

        $fileContent = explode(PHP_EOL, $output);
        $fileContent = array_filter($fileContent);
        $lineNumber = 0;

        foreach ($fileContent as $line)
        {
            $lineNumber++;
            $keyVal = explode('=', $line);

            if (isset($keyVal[0]) && isset($keyVal[1]))
                $_ENV[$keyVal[0]] = $keyVal[1];
            else
                echo "Unable to parse line {$lineNumber} of the .env.";
        }
    }
}
