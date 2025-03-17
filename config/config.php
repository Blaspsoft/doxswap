<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Here you may specify the driver to use for the conversion.
    |
    */
    'driver' => env('DOXSWAP_DRIVER', 'libreoffice'),

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may specify the drivers to use for the conversion.
    |
    */
    'drivers' => [
        'libreoffice' => [
            'path' => env('LIBRE_OFFICE_PATH', '/usr/bin/soffice'),
        ],
        'pandoc' => [
            'path' => env('PANDOC_PATH', '/usr/bin/pandoc'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the disk to use for storing the converted files.
    |
    */
    'input_disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Output Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the disk to use for storing the converted files.
    |
    */
    'output_disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Perform Cleanup
    |--------------------------------------------------------------------------
    |
    | Here you may specify if the cleanup should be performed.
    | If the cleanup is performed, the input file will be deleted after the
    | conversion is complete.
    |
    */
    'perform_cleanup' => false,

    /*
    |--------------------------------------------------------------------------
    | LibreOffice Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the path to the LibreOffice binary.
    |
    | Default Linux path: /usr/bin/soffice
    | Default Mac path: /Applications/LibreOffice.app/Contents/MacOS/soffice
    | Default Windows path: C:\Program Files\LibreOffice\program\soffice.exe
    |--------------------------------------------------------------------------
    */
    'libre_office_path' => env('LIBRE_OFFICE_PATH', '/usr/bin/soffice'),

    /*
    |--------------------------------------------------------------------------
    | Supported Conversions
    |--------------------------------------------------------------------------
    |
    | Here you may specify the supported conversions for each file type.
    | The key represents the file extension and the value is an array of
    | supported file types that it can be converted to.
    |
    */
    'supported_conversions' => [

        'doc' => [
            'pdf',
            'docx',
            'odt',
            'rtf',
            'txt',
            'html',
            'epub',
            'xml',
        ],

        'docx' => [
            'pdf',
            'odt',
            'rtf',
            'txt',
            'html',
            'epub',
            'xml',
        ],

        'odt' => [
            'pdf',
            'docx',
            'doc',
            'txt',
            'rtf',
            'html',
            'xml',
        ],

        'rtf' => [
            'pdf',
            'docx',
            'odt',
            'txt',
            'html',
            'xml',
        ],

        'txt' => [
            'pdf',
            'docx',
            'odt',
            'html',
            'xml',
        ],

        'html' => [
            'pdf',
            'odt',
            'txt',
        ],

        'xml' => [
            'pdf',
            'docx',
            'odt',
            'txt',
            'html',
        ],

        'csv' => [
            'pdf',
            'xlsx',
            'ods',
            'html',
        ],

        'xlsx' => [
            'pdf',
            'ods',
            'csv',
            'html',
        ],

        'xls' => [
            'pdf',
            'ods',
            'csv',
            'html',
        ],

        'ods' => [
            'pdf',
            'xlsx',
            'xls',
            'csv',
            'html',
        ],

        'pptx' => [
            'pdf',
            'odp',
        ],

        'ppt' => [
            'pdf',
            'odp',
        ],

        'odp' => [
            'pptx',
            'pdf',
        ],

        'svg' => [
            'pdf',
            'png',
            'jpg',
            'tiff',
        ],

        'jpg' => [
            'pdf',
            'png',
            'svg',
        ],

        'png' => [
            'pdf',
            'jpg',
            'svg',
        ],

        'bmp' => [
            'pdf',
            'jpg',
            'png',
        ],

        'tiff' => [
            'pdf',
            'jpg',
            'png',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | MIME Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the MIME types for the supported file extensions.
    | This is used to validate the file type before processing the conversion.
    | If the MIME type does not match the expected value, the conversion will fail.
    |
    */
    'mime_types' => [
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'odt' => 'application/vnd.oasis.opendocument.text',
        'rtf' => 'text/rtf',
        'txt' => 'text/plain',
        'html' => 'text/html',
        'xml' => 'text/xml',
        'csv' => 'text/csv',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xls' => 'application/vnd.ms-excel',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'ppt' => 'application/vnd.ms-powerpoint',
        'odp' => 'application/vnd.oasis.opendocument.presentation',
        'svg' => 'image/svg+xml',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'bmp' => 'image/bmp',
        'tiff' => 'image/tiff',
    ],
];
