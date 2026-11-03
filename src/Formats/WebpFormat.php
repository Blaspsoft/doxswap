<?php

namespace Blaspsoft\Doxswap\Formats;

class WebpFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'webp';
    }

    public function getMimeTypes(): array
    {
        return ['image/webp', 'image/x-webp'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'png', 'jpg', 'tiff', 'bmp', 'gif', 'svg'];
    }

    protected function usesImageMagick(?string $toFormat): bool
    {
        return $toFormat !== 'pdf';
    }
}
