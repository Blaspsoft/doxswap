<?php

namespace Blaspsoft\Doxswap\Strategies;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Pandoc implements ConversionStrategy
{
    /**
     * The path to the Pandoc binary.
     *
     * @var string
     */
    protected string $path;

     /**
     * The input disk.
     *
     * @var string
     */
    protected string $inputDisk;

    /**
     * The output disk.
     *
     * @var string
     */
    protected string $outputDisk;

    /**
     * Create a new PandocStrategy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->path = config('doxswap.drivers.pandoc_path');

        $this->inputDisk = config('doxswap.input_disk');

        $this->outputDisk = config('doxswap.output_disk');
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return string
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): string
    {
        $command = [
            $this->path,
            '--from', $fromFormat,
            '--to', $toFormat,
            $inputFile,
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return Storage::disk($this->outputDisk)->path(str_replace($fromFormat, $toFormat, basename($inputFile)));
    }
}
