<?php

namespace Blaspsoft\Doxswap\Formats;

class PptFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'ppt';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/powerpoint', 'application/x-powerpoint'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'odp'];
    }
}
