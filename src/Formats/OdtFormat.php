<?php

namespace Blaspsoft\Doxswap\Formats;

class OdtFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'odt';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.oasis.opendocument.text', 'application/x-vnd.oasis.opendocument.text', 'application/x-odt'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'doc', 'txt', 'rtf', 'html', 'xml'];
    }
}
