<?php

namespace Blaspsoft\Doxswap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Blaspsoft\Doxswap\ConversionResult convert(string $file, string $toFormat)
 * @method static bool supports(string $fromFormat, string $toFormat)
 * @method static array supportedFormats()
 */
class Doxswap extends Facade
{
    /**
     * Resolve the binding on each call, so config changes apply.
     *
     * @var bool
     */
    protected static $cached = false;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'doxswap';
    }
}
