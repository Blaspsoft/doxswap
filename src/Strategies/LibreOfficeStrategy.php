<?php

namespace Blaspsoft\Doxswap\Strategies;

use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class LibreOfficeStrategy implements ConversionStrategy
{
    /**
     * The path to the LibreOffice binary.
     *
     * @var string
     */
    protected string $path;

    /**
     * Create a new LibreOfficeStrategy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = config('doxswap.drivers.libreoffice.path');
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
        $command = "soffice --headless --convert-to {$outputFile} {$inputFile}";
        exec($command);
        return $outputFile;
    }
}