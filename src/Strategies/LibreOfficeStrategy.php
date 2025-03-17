<?php

namespace Blaspsoft\Doxswap\Strategies;

use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class LibreOfficeStrategy implements ConversionStrategy
{
    public function convert(string $inputFile, string $outputFile): string
    {
        $command = "soffice --headless --convert-to {$outputFile} {$inputFile}";
        exec($command);
        return $outputFile;
    }
}