<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\ConversionResult;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

abstract class AbstractFormat implements ConvertibleFormat
{
    /**
     * The LibreOffice strategy.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    protected ConversionStrategy $libreOffice;

    /**
     * Create a new format instance.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConversionStrategy $libreOffice
     */
    public function __construct(ConversionStrategy $libreOffice)
    {
        $this->libreOffice = $libreOffice;
    }

    abstract public function getName(): string;

    abstract public function getMimeTypes(): array;

    abstract public function getSupportedConversions(): array;

    /**
     * Get the driver for the conversion.
     *
     * @param string|null $toFormat
     * @return \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    public function getDriver(?string $toFormat = null): ConversionStrategy
    {
        return $this->libreOffice;
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
        return $this->getDriver($toFormat)->convert($inputFile, $this->getName(), $toFormat);
    }
}
