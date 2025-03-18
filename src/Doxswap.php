<?php

namespace Blaspsoft\Doxswap;

/**
 * @method static \Blaspsoft\Doxswap\Doxswap convert(string $file, string $toFormat)
 * @method static \Blaspsoft\Doxswap\Doxswap configure(string $disk, string $outputDisk)
 */
class Doxswap
{
    /**
     * The input file.
     *
     * @var string
     */
    public $inputFile;

    /**
     * The output file.
     *
     * @var string
     */
    public $outputFile;

    /**
     * The format to convert the file to.
     *
     * @var string
     */
    public $toFormat;

    /**
     * The converter.
     *
     * @var \Blaspsoft\Doxswap\Converter
     */
    protected $converter;

    public function __construct()
    {
        $this->converter = new Converter();
    }

    /**
     * Convert a file to a different format
     *
     * @param string $file The absolute path to the file to convert
     * @param string $format The format to convert the file to
     * @return self
     */
    public function convert($file, $toFormat)
    {
        $this->inputFile = $file;

        $this->toFormat = $toFormat;

        $this->outputFile = $this->converter->convert($this->inputFile, $this->toFormat);

        return $this;
    }

    /**
     * Set the driver for the converter.
     *
     * @param string $driver
     * @return self
     */
    public function driver(string $driver): self
    {
        $this->converter->setStrategy($driver);

        return $this;
    }
}
