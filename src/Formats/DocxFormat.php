<?php

namespace Blaspsoft\Doxswap\Formats;

class DocxFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'docx';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-word.document.macroEnabled.12', 'application/x-docx'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'];
    }
}
