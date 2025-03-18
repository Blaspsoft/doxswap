<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\Facades\Storage;

class ConversionCleanup
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
     * The cleanup strategy.
     *
     * @var string
     */
    protected string $strategy;

    /**
     * Create a new ConversionCleanup instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');

        $this->outputDisk = config('doxswap.output_disk');

        $this->strategy = config('doxswap.cleanup_strategy'); // Cleanup strategies input, output, both, none
    }

    /**
     * Cleanup the input file.
     *
     * @param string $inputFile
     * @return void
     */
    protected function cleanupInput(string $inputFile): void
    {
        Storage::disk($this->inputDisk)->delete($inputFile);
    }

    /**
     * Cleanup the output file.
     *
     * @param string $outputFile
     * @return void
     */
    protected function cleanupOutput(string $outputFile): void
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
    protected function cleanupInputAndOutput(string $inputFile, string $outputFile): void
    {
        $this->cleanupInput($inputFile);
        
        $this->cleanupOutput($outputFile);
    }

    /**
     * Cleanup the input file and output files based on the strategy.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return void
     */
    public function cleanup(string $inputFile, string $outputFile): void
    {
        match ($this->strategy) {
            'input' => $this->cleanupInput($inputFile),
            'output' => $this->cleanupOutput($outputFile),
            'both' => $this->cleanupInputAndOutput($inputFile, $outputFile),
            'none' => null,
        };
    }
}