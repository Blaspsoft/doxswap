<?php

namespace Blaspsoft\Doxswap\Exceptions;

use InvalidArgumentException;

class FormatNotFoundException extends InvalidArgumentException
{
    public function __construct(string $format)
    {
        parent::__construct("Format '{$format}' not found.");
    }
}
