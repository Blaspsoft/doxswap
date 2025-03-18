<?php

namespace Blaspsoft\Doxswap\Exceptions;

use Exception;

class InputFileNotFoundException extends Exception
{
    public function __construct(string $inputFile)
    {
        $message = "Input file not found: {$inputFile}";
        parent::__construct($message, 0); // Note the integer 0 for code
    }
}