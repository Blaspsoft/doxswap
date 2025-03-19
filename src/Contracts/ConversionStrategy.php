<?php

namespace Blaspsoft\Doxswap\Contracts;

interface ConversionStrategy
{
    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return string
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): string;
}