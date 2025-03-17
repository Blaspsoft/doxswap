<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Doxswap\Strategies\PandocStrategy;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\Strategies\LibreOfficeStrategy;

class Converter
{
    /**
     * The strategy to use for the conversion.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    protected ConversionStrategy $strategy;

    /**
     * Create a new converter instance.
     *
     * @param string $driver
     * @return void
     */
    public function __construct(string $driver) 
    {
        $this->strategy = match ($driver) {
            'libreoffice' => new LibreOfficeStrategy(),
            'pandoc' => new PandocStrategy(),
            default => throw new \Exception("Invalid driver: {$driver}"),
        };
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
        return $this->strategy->convert($inputFile, $outputFile);
    }
}