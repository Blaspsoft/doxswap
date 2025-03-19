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
                'svg' => ['pdf', 'png', 'jpg', 'tiff'],
                'jpg' => ['pdf', 'png', 'svg'],
                'png' => ['pdf', 'jpg', 'svg'],
                'bmp' => ['pdf', 'jpg', 'png'],
                'tiff' => ['pdf', 'jpg', 'png'],
            ],


            'mime_types' => [
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
