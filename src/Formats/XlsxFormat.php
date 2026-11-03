<?php

namespace Blaspsoft\Doxswap\Formats;

class XlsxFormat extends AbstractFormat
{
    public function getName(): string
    {
        return 'xlsx';
    }

    public function getMimeTypes(): array
    {
        return ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel.sheet.macroEnabled.12', 'application/x-xlsx', 'application/vnd.ms-excel', 'application/octet-stream'];
    }

    public function getSupportedConversions(): array
    {
        return ['pdf', 'ods', 'csv', 'html'];
    }
}
