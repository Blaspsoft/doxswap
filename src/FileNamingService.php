<?php

namespace Blaspsoft\Doxswap;

class FileNamingService
{
    /**
     * Create a new FileNamingService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');
        $this->outputDisk = config('doxswap.output_disk');
    }

    /**
     * Get the input file name.
     *
     * @return string
     */
    public function getInputFileName(): string
    {
        return $this->inputDisk . '/' . $this->inputFile;
    }

    /**
     * Get the output file name.
     *
     * @return string
     */
    public function getOutputFileName(): string
    {
        return $this->outputDisk . '/' . $this->outputFile;
    }
}