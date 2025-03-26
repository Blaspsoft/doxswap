<?php

return [

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
    | Cleanup
    |--------------------------------------------------------------------------
    |
    | Here you may specify if the input file should be deleted after the conversion.
    |
    */
    'perform_cleanup' => false,

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
    | Supported drivers:
    | - libreoffice: The LibreOffice driver.
    |   
    */
    'drivers' => [
        'libreoffice_path' => env('LIBRE_OFFICE_PATH', '/usr/bin/soffice'),
    ],
];
