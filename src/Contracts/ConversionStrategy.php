<?php

namespace Blaspsoft\Doxswap\Contracts;

interface ConversionStrategy
{
    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return string
     */
    public function convert(string $inputFile, string $outputFile): string;
}