<?php

namespace Blaspsoft\Doxswap\Formats;

class OdpFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'odp';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.oasis.opendocument.presentation', 'application/x-vnd.oasis.opendocument.presentation'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'pptx', 'ppt'];
    }
}
