<?php

namespace Blaspsoft\Doxswap\Exceptions;

use RuntimeException;

class ImagickExtensionNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Imagick extension is not installed or enabled.');
    }
}
