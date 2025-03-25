<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\ConversionResult;
use Blaspsoft\Doxswap\Strategies\LibreOffice;

class CsvFormat implements ConvertibleFormat
{
    /**
     * Get the name of the format.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'csv';
    }

    /**
     * Get the MIME types of the format.
     *
     * @return array
     */
    public function getMimeTypes(): array
    {
        return ['text/csv', 'text/x-csv', 'application/csv', 'application/x-csv', 'text/tab-separated-values'];
    }

    /**
     * Get the supported conversions for the format.
     *
     * @return array
     */
    public function getSupportedConversions(): array
    {
        return ['pdf', 'xlsx', 'ods', 'html'];
    }

    /**
     * Get the supported drivers of the format.
     *
     * @return \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    public function getDriver(): ConversionStrategy
    {
        return new LibreOffice();
    }

    /**
     * Convert the format to a new format.
     *
     * @param string $inputFile
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $inputFile, string $toFormat): ConversionResult
    {
        return $this->getDriver()->convert($inputFile, $this->getName(), $toFormat);
    }
}