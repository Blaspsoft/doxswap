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
     * The ImageMagick strategy.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionStrategy|null
     */
    protected ?ConversionStrategy $imageMagick;

    /**
     * Create a new format instance.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConversionStrategy $libreOffice
     * @param \Blaspsoft\Doxswap\Contracts\ConversionStrategy|null $imageMagick
     */
    public function __construct(ConversionStrategy $libreOffice, ?ConversionStrategy $imageMagick = null)
    {
        $this->libreOffice = $libreOffice;
        $this->imageMagick = $imageMagick;
    }

    abstract public function getName(): string;

    abstract public function getMimeTypes(): array;

    abstract public function getSupportedConversions(): array;

    /**
     * Determine if the conversion should use ImageMagick.
     *
     * @param string|null $toFormat
     * @return bool
     */
    protected function usesImageMagick(?string $toFormat): bool
    {
        return false;
    }

    /**
     * Get the driver for the conversion.
     *
     * @param string|null $toFormat
     * @return \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    public function getDriver(?string $toFormat = null): ConversionStrategy
    {
        if ($this->usesImageMagick($toFormat) && $this->imageMagick !== null) {
            return $this->imageMagick;
        }

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
