<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Doxswap\ConversionCleanup;

class Converter
{
    /**
     * The strategy to use for the conversion.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConvertibleFormat
     */
    protected FormatRegistry $formatRegistry;

    /**
     * The cleanup to use for the conversion.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionCleanup
     */
    protected ConversionCleanup $cleanup;

    /**
     * Create a new converter instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->formatRegistry = new FormatRegistry();

        $this->cleanup = new ConversionCleanup();
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $inputFile, string $toFormat): ConversionResult
    {
        $outputFile = $this->formatRegistry->convert($inputFile, $toFormat);

        return $outputFile; // TODO: Need to find a place to put the rename feature
        
        $outputFile = Filename::rename($outputFile);

        $this->cleanup->cleanup($inputFile, $outputFile);

        return $outputFile;
    }
}