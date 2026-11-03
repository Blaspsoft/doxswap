<?php

namespace Blaspsoft\Doxswap\Formats;

class OdsFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'ods';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.oasis.opendocument.spreadsheet', 'application/x-vnd.oasis.opendocument.spreadsheet', 'application/x-ods'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'xlsx', 'xls', 'csv', 'html'];
    }
}
