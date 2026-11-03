<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Onym\Facades\Onym;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Filename
{
    /**
     * The file naming strategy.
     *
     * @var string
     */
    protected string $strategy;

    /**
     * The file naming options.
     *
     * @var array
     */
    protected array $options;

    /**
     * The output disk.
     *
     * @var string
     */
    protected string $outputDisk;

    /**
     * Create a new Filename instance.
     *
     * @param string $strategy
     * @param array $options
     * @param string $outputDisk
     */
    public function __construct(string $strategy, array $options, string $outputDisk)
    {
        $this->strategy = $strategy;
        $this->options = $options;
        $this->outputDisk = $outputDisk;
    }

    /**
     * Generate a file name based on the strategy.
     *
     * @param string $filePath
     * @return string
     */
    protected function generateFileName(string $filePath): string
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        return match ($this->strategy) {
            'original' => basename($filePath),
            'random' => Onym::make(strategy: 'random', extension: $extension, options: $this->options),
            'timestamp' => Onym::make(strategy: 'timestamp', extension: $extension, options: $this->options),
        };
    }

    /**
     * Rename the file.
     *
     * @param string $filePath
     * @return string
     */
    public function rename(string $filePath): string
    {
        $filename = $this->generateFileName($filePath);

        $newOutputFilePath = Storage::disk($this->outputDisk)->path($filename);

        File::move($filePath, $newOutputFilePath);

        return $newOutputFilePath;
    }
}
