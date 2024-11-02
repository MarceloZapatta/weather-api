<?php

namespace App\Exceptions;

use Exception;


class LocationUserAlreadyExistsException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "Location user already exists.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
