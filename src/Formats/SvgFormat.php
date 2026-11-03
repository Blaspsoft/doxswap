<?php

namespace Blaspsoft\Doxswap\Formats;

class SvgFormat extends AbstractImageFormat
{
    public function getName(): string
    {
        return 'svg';
    }

    public function getMimeTypes(): array
    {
        return ['image/svg+xml', 'application/svg+xml', 'image/x-svg+xml', 'image/svg', 'image/x-svg'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'png', 'jpg', 'tiff', 'bmp', 'webp', 'gif'];
    }
}
