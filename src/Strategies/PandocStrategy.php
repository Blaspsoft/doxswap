<?php

namespace Blaspsoft\Doxswap\Strategies;

use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class PandocStrategy implements ConversionStrategy
{
    /**
     * The path to the Pandoc binary.
     *
     * @var string
     */
    protected string $path;

    /**
     * Create a new PandocStrategy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = config('doxswap.drivers.pandoc.path');
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return string
     */
    public function convert(string $inputFile, string $outputFile): string
    {
        $command = "{$this->path} {$inputFile} -o {$outputFile}";
        exec($command);
        return $outputFile;
    }
}
