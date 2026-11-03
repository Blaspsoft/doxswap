<?php

namespace Blaspsoft\Doxswap\Formats;

class WebpFormat extends AbstractImageFormat
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
}
