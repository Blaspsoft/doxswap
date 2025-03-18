<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Strategies\Pandoc;
use Blaspsoft\Doxswap\Strategies\LibreOffice;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

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
     * Get the MIME type of the format.
     *
     * @return string
     */
    public function getMimeType(): string
    {
        return 'application/msword';
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
     * @param string $outputFile
     * @return string
     */
    public function convert(string $inputFile, string $outputFile): string
    {
        return $this->getDriver()->convert($inputFile, $outputFile);
    }
}
