<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\Facades\Storage;

class ConversionCleanupService
{
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
     * The perform cleanup flag.
     *
     * @var bool
     */
    protected bool $performCleanup;

    /**
     * Create a new ConversionCleanupService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');

        $this->outputDisk = config('doxswap.output_disk');

        $this->performCleanup = config('doxswap.perform_cleanup');
    }

    /**
     * Cleanup the input file.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return void
     */
    public function cleanupInputFile(string $inputFile): void
    {
        Storage::disk($this->inputDisk)->delete($inputFile);
    }

    /**
     * Cleanup the output file.
     *
     * @param string $outputFile
     * @return void
     */
    public function cleanupOutputFile(string $outputFile): void
    {
        Storage::disk($this->outputDisk)->delete($outputFile);
    }

    /**
     * Cleanup the input and output files.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return void
     */
    public function cleanup(string $inputFile, string $outputFile): void
    {
        $this->cleanupInputFile($inputFile);
        $this->cleanupOutputFile($outputFile);
    }
}