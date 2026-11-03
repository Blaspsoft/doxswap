<?php

namespace Blaspsoft\Doxswap\Formats;

class JpgFormat extends AbstractImageFormat
{
    public function getName(): string
    {
        return 'jpg';
    }

    public function getMimeTypes(): array
    {
        return ['image/jpeg', 'image/pjpeg', 'image/jpg', 'image/x-jpeg'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'png', 'svg', 'tiff', 'bmp', 'webp', 'gif'];
    }
}
