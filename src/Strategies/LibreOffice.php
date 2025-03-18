<?php

namespace Blaspsoft\Doxswap\Strategies;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LibreOffice implements ConversionStrategy
{
    /**
     * The path to the LibreOffice binary.
     *
     * @var string
     */
    protected string $path;

    /**
     * Create a new LibreOfficeStrategy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = config('doxswap.drivers.libreoffice.path');
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return string
     */
    public function convert(string $inputFile, string $toFormat): string
    {
        $command = [
            $this->path, // Path to the LibreOffice binary
            '--headless', // Run in headless mode
            '--convert-to', $toFormat , // Convert to the specified format
            '--outdir', Storage::disk('public')->path(''), // Output directory
            $inputFile, // Input file
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return 'test';
    }
}