<?php

namespace App\Exceptions;

use Exception;

class UnableToFetchWeatherNewLocationException extends Exception
{
    public function __construct(string $message = "Unable to fetch weather for the new location", int $code = 0)
    {
        parent::__construct($message, $code);
    }
}