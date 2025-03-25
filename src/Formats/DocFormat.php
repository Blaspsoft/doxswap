<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Strategies\LibreOffice;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\ConversionResult;

class DocFormat implements ConvertibleFormat
{
    /**
     * Get the name of the format.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'doc';
    }

    /**
     * Get the MIME types of the format.
     *
     * @return array
     */
    public function getMimeTypes(): array
    {
        return ['application/msword', 'application/x-msword', 'application/vnd.ms-word', 'application/doc'];
    }

    /**
     * Get the supported conversions of the format.
     *
     * @return array
     */
    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'];
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
