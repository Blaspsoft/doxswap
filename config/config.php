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
    | Cleanup Strategy
    |--------------------------------------------------------------------------
    |
    | Here you may specify the cleanup strategy to use.
    |
    | Supported strategies:
    | - none: No cleanup is performed.
    | - input: Only the input file is deleted.
    | - output: Only the output file is deleted.
    | - both: Both the input and output files are deleted.
    |
    */
    'cleanup_strategy' => env('DOXSWAP_CLEANUP_STRATEGY', 'none'),

    /*
    |--------------------------------------------------------------------------
    | File Naming Strategy
    |--------------------------------------------------------------------------
    |
    | Here you may specify the file naming strategy to use.
    | This strategy is used to rename the output file.
    |
    */
    'filename' => [

        /*
        |--------------------------------------------------------------------------
        | Strategy
        |--------------------------------------------------------------------------
        |
        | The strategy to use for the file naming.
        |   
        | Supported strategies:
        | - original: The original file name is used.
        | - random: A random file name is generated.
        | - timestamp: A timestamp is generated.
        |
        */
        'strategy' => 'original',

        /*
        |--------------------------------------------------------------------------
        | Options
        |--------------------------------------------------------------------------
        |
        | The options to use for the file naming.
        |
        | Supported options:
        | - length: The length of the random file name.
        | - prefix: The prefix of the file name.
        | - suffix: The suffix of the file name.
        | - separator: The separator of the file name.
        | - format: The format of the timestamp.
        |   
        */
        'options' => [
            'length' => 24,
            'prefix' => '',
            'suffix' => '',
            'separator' => '_',
            'format' => 'YmdHis',
        ],
    ],


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

            /*
            |--------------------------------------------------------------------------
            | Supported Conversions
            |--------------------------------------------------------------------------
            |
            | Here you may specify the supported conversions for each file type.
            |
            */
            'supported_conversions' => [
                //'doc' => ['pdf', 'docx', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'],
                //'docx' => ['pdf', 'odt', 'rtf', 'txt', 'html', 'epub', 'xml'],
                //'odt' => ['pdf', 'docx', 'doc', 'txt', 'rtf', 'html', 'xml'],
                //'rtf' => ['pdf', 'docx', 'odt', 'txt', 'html', 'xml'],
                //'txt' => ['pdf', 'docx', 'odt', 'html', 'xml'],
                //'html' => ['pdf', 'odt', 'txt'],
                //'xml' => ['pdf', 'docx', 'odt', 'txt', 'html'],
                'csv' => ['pdf', 'xlsx', 'ods', 'html'],
                'xlsx' => ['pdf', 'ods', 'csv', 'html'],
                'ods' => ['pdf', 'xlsx', 'xls', 'csv', 'html'],
                'xls' => ['pdf', 'ods', 'csv', 'html'],
                'pptx' => ['pdf', 'odp'],
                'ppt' => ['pdf', 'odp'],
                'odp' => ['pdf', 'pptx', 'ppt'],
                'svg' => ['pdf', 'png', 'jpg', 'tiff'],
                'jpg' => ['pdf', 'png', 'svg'],
                'png' => ['pdf', 'jpg', 'svg'],
                'bmp' => ['pdf', 'jpg', 'png'],
                'tiff' => ['pdf', 'jpg', 'png'],
            ],

            /*
            |--------------------------------------------------------------------------
            | MIME Types
            |--------------------------------------------------------------------------
            |
            | Here you may specify the MIME types for the supported file extensions.
            |
            */
            'mime_types' => [
                //'doc' => 'application/msword',
                //'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                //'odt' => 'application/vnd.oasis.opendocument.text',
                //'rtf' => 'text/rtf',
                //'txt' => 'text/plain',
                //'html' => 'text/html',
                //'xml' => 'text/xml',
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
            ]

        ],

        'pandoc' => [

            'path' => env('PANDOC_PATH', '/usr/bin/pandoc'),
        ],
    ],
];
