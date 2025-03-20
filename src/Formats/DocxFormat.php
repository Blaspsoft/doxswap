<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Strategies\LibreOffice;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class DocxFormat implements ConvertibleFormat
{
    /**
     * Get the name of the format.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'docx';
    }

    /**
     * Get the MIME types of the format.
     *
     * @return array
     */
    public function getMimeTypes(): array
    {
        return ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-word.document.macroEnabled.12', 'application/x-docx'];
    }

    /**
     * Get the supported conversions of the format.
     *
     * @return array
     */
    public function getSupportedConversions(): array
    {
        return ['pdf', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'];
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
     * @return string
     */
    public function convert(string $inputFile, string $toFormat): string
    {
        return $this->getDriver()->convert($inputFile, $this->getName(), $toFormat);
    }
}
