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
     * Whether to perform cleanup.
     *
     * @var bool
     */
    protected bool $performCleanup;

    /**
     * Create a new ConversionCleanup instance.
     *
     * @param string $inputDisk
     * @param bool $performCleanup
     */
    public function __construct(string $inputDisk, bool $performCleanup)
    {
        $this->inputDisk = $inputDisk;
        $this->performCleanup = $performCleanup;
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
