<?php

namespace Blaspsoft\Doxswap\Formats;

class PngFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'png';
    }

    public function getMimeTypes(): array
    {
        return ['image/png', 'image/x-png'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'jpg', 'svg', 'tiff', 'bmp', 'webp', 'gif'];
    }

    protected function usesImageMagick(?string $toFormat): bool
    {
        return $toFormat !== 'pdf';
    }
}
