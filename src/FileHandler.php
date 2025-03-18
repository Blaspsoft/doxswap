<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Onym\Facades\Onym;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileHandler
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
     * Create a new FileNamingService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->strategy = config('doxswap.filename.strategy');

        $this->options = config('doxswap.filename.options');

        $this->outputDisk = config('doxswap.output_disk');
    }

    /**
     * Generate a file name based on the strategy.
     *
     * @return string
     */
    protected function generate(string $outputFile): string
    {
        return match ($this->strategy) {
            'original' => basename($outputFile),
            'random' => Onym::make(strategy: 'random', extension: $outputFile, options: $this->options),
            'timestamp' => Onym::make(strategy: 'timestamp', extension: $outputFile, options: $this->options),
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
        $filename = $this->generate($filePath);

        $newOutputFilePath = Storage::disk($this->outputDisk)->path($filename);

        File::move($filePath, $newOutputFilePath);

        return $newOutputFilePath;
    }
}