<?php

namespace Blaspsoft\Doxswap\Formats;

class XlsFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'xls';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'ods', 'csv', 'html'];
    }
}
