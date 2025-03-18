<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Doxswap\ConversionCleanup;
use Blaspsoft\Doxswap\Strategies\Pandoc;
use Blaspsoft\Doxswap\Strategies\LibreOffice;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;

class Converter
{
    /**
     * The strategy to use for the conversion.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConvertibleFormat
     */
    protected FormatRegistry $formatRegistry;

    /**
     * The file naming service.
     *
     * @var \Blaspsoft\Doxswap\FileHandler
     */
    protected FileHandler $fileHandler; 

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
     * @return string
     */
    public function convert(string $inputFile, string $toFormat): string
    {
        $outputFile = $this->formatRegistry->convert($inputFile, $toFormat);

        $outputFile = $this->fileHandler->rename($outputFile);

        $this->cleanup->cleanup($inputFile, $outputFile);

        return $outputFile;
    }
}