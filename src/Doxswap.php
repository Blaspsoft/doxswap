<?php

namespace Blaspsoft\Doxswap;

/**
 * @method static \Blaspsoft\Doxswap\Doxswap convert(string $file, string $toFormat)
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

    /**
     * Create a new Doxswap instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->converter = new Converter();
    }

    /**
     * Convert a file to a different format
     *
     * @param string $file The absolute path to the file to convert
     * @param string $toFormat The format to convert the file to
     * @return self
     */
    public function convert(string $file, string $toFormat)
    {
        $this->inputFile = $file;

        $this->toFormat = $toFormat;

        $this->outputFile = $this->converter->convert($this->inputFile, $this->toFormat);

        return $this;
    }
}
