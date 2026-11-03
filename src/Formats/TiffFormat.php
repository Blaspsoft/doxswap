<?php

namespace Blaspsoft\Doxswap\Formats;

class TiffFormat extends AbstractImageFormat
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
}
