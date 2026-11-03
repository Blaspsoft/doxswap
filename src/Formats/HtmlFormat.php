<?php

namespace Blaspsoft\Doxswap\Formats;

class HtmlFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'html';
    }

    public function getMimeTypes(): array
    {
        return ['text/html', 'application/xhtml+xml', 'application/x-html', 'text/plain'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'odt', 'txt'];
    }
}
