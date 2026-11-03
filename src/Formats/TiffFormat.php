<?php

namespace Blaspsoft\Doxswap\Formats;

class TiffFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'tiff';
    }

    public function getMimeTypes(): array
    {
        return ['image/tiff', 'image/x-tiff', 'image/tif', 'image/x-tif'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'jpg', 'png', 'svg', 'bmp', 'webp', 'gif'];
    }

    protected function usesImageMagick(?string $toFormat): bool
    {
        return $toFormat !== 'pdf';
    }
}
