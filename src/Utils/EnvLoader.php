<?php
namespace Utils;

use Exception;

class EnvLoader
{
    protected $envPath;

    public function __construct()
    {
        $this->envPath = $_SERVER["DOCUMENT_ROOT"] . '/wo/api/' . '/.env';
    }

    public function load()
    {
        try
        {
            $output = file_get_contents($this->envPath);
 
            if ($output === false || $output == '')
            {
                throw new Exception();
            }
        }
        catch (Exception $e)
        {
            echo "There is an issue with the .env file";
            die();
        }

        $fileContent = explode(PHP_EOL, $output);
        $fileContent = array_filter($fileContent);
        $lineNumber = 0;

        foreach ($fileContent as $line)
        {
            $lineNumber++;
            $keyVal = explode('=', $line);

            if (isset($keyVal[0]) && isset($keyVal[1]))
            {
                $_ENV[$keyVal[0]] = $keyVal[1];
            }
            else
            {
                trigger_error('There was an issue reading the .env file around line ' . $lineNumber, E_USER_WARNING);
            }
        }
    }
}
