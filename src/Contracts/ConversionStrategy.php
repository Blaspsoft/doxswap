<?php

namespace Blaspsoft\Doxswap\Contracts;

use Blaspsoft\Doxswap\ConversionResult;

interface ConversionStrategy
{
    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): ConversionResult;
}