<?php

namespace Blaspsoft\Doxswap\Formats;

class XmlFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'xml';
    }

    public function getMimeTypes(): array
    {
        return ['text/xml', 'application/xml', 'application/x-xml', 'text/x-xml', 'application/rss+xml'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'odt', 'txt', 'html'];
    }
}
