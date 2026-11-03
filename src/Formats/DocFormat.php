<?php

namespace Blaspsoft\Doxswap\Formats;

class DocFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'doc';
    }

    public function getMimeTypes(): array
    {
        return ['application/msword', 'application/x-msword', 'application/vnd.ms-word', 'application/doc'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'];
    }
}
