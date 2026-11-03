<?php

namespace Blaspsoft\Doxswap\Formats;

class TxtFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'txt';
    }

    public function getMimeTypes(): array
    {
        return ['text/plain', 'text/x-plain', 'text/x-txt', 'text/x-text'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'odt', 'html', 'xml'];
    }
}
