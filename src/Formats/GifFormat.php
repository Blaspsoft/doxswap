<?php

namespace Blaspsoft\Doxswap\Formats;

class GifFormat extends AbstractImageFormat
{
    public function getName(): string
    {
        return 'gif';
    }

    public function getMimeTypes(): array
    {
        return ['image/gif', 'image/x-gif'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'png', 'jpg', 'tiff', 'bmp', 'webp', 'svg'];
    }
}
