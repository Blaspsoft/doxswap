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
    public static function rename(string $filePath): string
    {
        $instance = new self();

        $filename = $instance->generateFileName($filePath);

        $newOutputFilePath = Storage::disk($instance->outputDisk)->path($filename);

        File::move($filePath, $newOutputFilePath);

        return $newOutputFilePath;
    }
}