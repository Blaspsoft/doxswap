<?php

namespace Blaspsoft\Doxswap\Strategies;

use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class PandocStrategy implements ConversionStrategy
{
    public function convert(string $inputFile, string $outputFile): string
    {
        $command = "pandoc {$inputFile} -o {$outputFile}";
        exec($command);
        return $outputFile;
    }
}
