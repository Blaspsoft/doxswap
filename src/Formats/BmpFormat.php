<?php

namespace Blaspsoft\Doxswap\Formats;

class BmpFormat extends AbstractImageFormat
{
    public function getName(): string
    {
        return 'bmp';
    }

    public function getMimeTypes(): array
    {
        return ['image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-ms-bmp'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'jpg', 'png', 'svg', 'tiff', 'webp', 'gif'];
    }
}
