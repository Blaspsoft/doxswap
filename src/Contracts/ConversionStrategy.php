<?php

namespace Blaspsoft\Doxswap\Contracts;

interface ConversionStrategy
{
    public function convert(string $inputFile, string $outputFile): string;
}