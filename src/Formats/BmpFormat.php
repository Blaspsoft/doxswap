<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\Strategies\LibreOffice;

class BmpFormat implements ConvertibleFormat
{
    /**
     * Get the name of the format.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'bmp';
    }

    /**
     * Get the MIME types of the format.
     *
     * @return array
     */
    public function getMimeTypes(): array
    {
        return ['image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-ms-bmp'];
    }

    /**
     * Get the supported conversions for the format.
     *
     * @return array
     */
    public function getSupportedConversions(): array
    {
        return ['pdf', 'jpg', 'png'];
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