<?php

namespace Blaspsoft\Doxswap;

/**
 * @method static \Blaspsoft\Doxswap\Doxswap convert(string $file, string $toFormat)
 */
class Doxswap
{
    /**
     * The format registry.
     *
     * @var \Blaspsoft\Doxswap\FormatRegistry
     */
    protected FormatRegistry $formatRegistry;

    /**
     * The cleanup.
     *
     * @var \Blaspsoft\Doxswap\ConversionCleanup
     */
    protected ConversionCleanup $cleanup;

    /**
     * The result.
     *
     * @var \Blaspsoft\Doxswap\ConversionResult|null
     */
    protected ?ConversionResult $result = null;

    /**
     * Create a new Doxswap instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->formatRegistry = new FormatRegistry();

        $this->cleanup = new ConversionCleanup();
    }

    /**
     * Convert a file to a different format
     *
     * @param string $file The absolute path to the file to convert
     * @param string $toFormat The format to convert the file to
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $file, string $toFormat): ConversionResult
    {
        $this->result = $this->formatRegistry->convert($file, $toFormat);

        $this->cleanup->cleanup($this->result->inputFilename);

        return $this->result;
    }
}

