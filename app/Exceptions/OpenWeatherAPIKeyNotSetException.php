<?php

namespace App\Exceptions;

use Exception;

class OpenWeatherAPIKeyNotSetException extends Exception
{
  protected $message = 'The OpenWeather API key is not set.';

  public function __construct()
  {
    parent::__construct($this->message);
  }
}
