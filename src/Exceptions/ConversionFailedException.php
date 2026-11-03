<?php

namespace Blaspsoft\Doxswap\Exceptions;

use Exception;

class ConversionFailedException extends Exception
{
    public function __construct($message = "Conversion failed", $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}