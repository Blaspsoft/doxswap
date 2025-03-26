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
     * The cleanup strategy.
     *
     * @var string
     */
    protected bool $performCleanup;

    /**
     * Create a new ConversionCleanup instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');

        $this->performCleanup = config('doxswap.perform_cleanup');
    }

    /**
     * Cleanup the input file and output files based on the strategy.
     *
     * @param string $inputFile
     * @return void
     */
    public function cleanup(string $inputFile): void
    {
        if ($this->performCleanup) {
            Storage::disk($this->inputDisk)->delete($inputFile);
        }
    }
}