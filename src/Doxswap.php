<?php

namespace Blaspsoft\Doxswap;

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
     * Create a new Doxswap instance.
     *
     * @param \Blaspsoft\Doxswap\FormatRegistry $formatRegistry
     * @param \Blaspsoft\Doxswap\ConversionCleanup $cleanup
     */
    public function __construct(FormatRegistry $formatRegistry, ConversionCleanup $cleanup)
    {
        $this->formatRegistry = $formatRegistry;
        $this->cleanup = $cleanup;
    }

    /**
     * Convert a file to a different format.
     *
     * @param string $file The path to the file relative to the input disk
     * @param string $toFormat The format to convert the file to
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $file, string $toFormat): ConversionResult
    {
        $result = $this->formatRegistry->convert($file, $toFormat);

        $this->cleanup->cleanup($result->inputFilename);

        return $result;
    }

    /**
     * Check if a conversion is supported.
     *
     * @param string $fromFormat
     * @param string $toFormat
     * @return bool
     */
    public function supports(string $fromFormat, string $toFormat): bool
    {
        try {
            $format = $this->formatRegistry->getFormat($fromFormat);
            return $this->formatRegistry->isSupportedConversion($format, $toFormat);
        } catch (\Blaspsoft\Doxswap\Exceptions\FormatNotFoundException $e) {
            return false;
        }
    }

    /**
     * Get all supported format names.
     *
     * @return array
     */
    public function supportedFormats(): array
    {
        return array_keys($this->formatRegistry->getAllFormats());
    }
}
