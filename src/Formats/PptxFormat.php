<?php

namespace Blaspsoft\Doxswap\Formats;

class PptxFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'pptx';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/x-pptx'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'odp'];
    }
}
