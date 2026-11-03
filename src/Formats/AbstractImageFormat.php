<?php

namespace Blaspsoft\Doxswap\Formats;

use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

abstract class AbstractImageFormat extends AbstractFormat
{
    /**
     * The ImageMagick strategy.
     *
     * @var \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    protected ConversionStrategy $imageMagick;

    /**
     * Create a new image format instance.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConversionStrategy $libreOffice
     * @param \Blaspsoft\Doxswap\Contracts\ConversionStrategy $imageMagick
     */
    public function __construct(ConversionStrategy $libreOffice, ConversionStrategy $imageMagick)
    {
        parent::__construct($libreOffice);

        $this->imageMagick = $imageMagick;
    }

    /**
     * Get the driver for the conversion. PDF output uses LibreOffice,
     * image-to-image conversions use ImageMagick.
     *
     * @param string|null $toFormat
     * @return \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    public function getDriver(?string $toFormat = null): ConversionStrategy
    {
        return $toFormat === 'pdf' ? $this->libreOffice : $this->imageMagick;
    }
}
