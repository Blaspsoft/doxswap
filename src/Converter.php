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
     * The validator to use for the conversion.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionValidator
     */
    protected ConversionValidator $validator;

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
        $driver = config('doxswap.driver');

        $this->setStrategy($driver);

        $this->validator = new ConversionValidator($driver);

        $this->cleanup = new ConversionCleanup();
    }

    /** 
     * Set the strategy for the converter.
     *
     * @param string $driver
     * @return void
     */
    public function setStrategy(string $driver): void
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
        $driver = get_class($this->strategy);

        $this->validator->validate($inputFile, $outputFile, $driver);

        $outputFile = $this->strategy->convert($inputFile, $outputFile);

        $this->cleanup->cleanup($inputFile, $outputFile);

        return $outputFile;
    }
}