<?php

namespace Blaspsoft\Doxswap\Formats;

class CsvFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'csv';
    }

    public function getMimeTypes(): array
    {
        return ['text/csv', 'text/x-csv', 'application/csv', 'application/x-csv', 'text/tab-separated-values'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'xlsx', 'ods', 'html'];
    }
}
