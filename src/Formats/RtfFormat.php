<?php

namespace Blaspsoft\Doxswap\Formats;

class RtfFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'rtf';
    }

    public function getMimeTypes(): array
    {
        return ['text/rtf', 'application/rtf', 'application/x-rtf', 'text/richtext'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'odt', 'txt', 'html', 'xml'];
    }
}
