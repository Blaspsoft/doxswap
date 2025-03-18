<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Formats\DocFormat;
use Blaspsoft\Doxswap\Formats\DocxFormat;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;

class FormatRegistry
{
    /**
     * The formats in the registry.
     *
     * @var array
     */
    protected array $formats = [];

    /**
     * The input disk.
     *
     * @var string
     */
    protected string $inputDisk;

    /**
     * Create a new FormatRegistry instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');

        $this->register(new DocFormat());

        $this->register(new DocxFormat());
    }

    /**
     * Register a format.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConvertibleFormat $format
     * @return void
     */
    public function register(ConvertibleFormat $format): void
    {
        $this->formats[$format->getName()] = $format;
    }

    /**
     * Get a format by name.
     *
     * @param string $name
     * @return \Blaspsoft\Doxswap\Contracts\ConvertibleFormat
     */
    public function getFormat(string $name): ConvertibleFormat
    {
        return $this->formats[$name];
    }

    /**
     * Check if a conversion is supported.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConvertibleFormat $inputFormat
     * @param string $outputFormat
     * @return bool
     */
    public function isSupportedConversion(ConvertibleFormat $inputFormat, string $outputFormat): bool
    {
        return in_array($outputFormat, $inputFormat->getSupportedConversions());
    }

    /** 
     * Check if a mime type is supported.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConvertibleFormat $format
     * @param string $mimeType
     * @return bool
     */
    public function isSupportedMimeType(ConvertibleFormat $format, string $mimeType): bool
    {
        return Str::is($format->getMimeType(), $mimeType);
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $toFormat
     * @return string
     */
    public function convert(string $inputFile, string $toFormat): string
    {
        // Check if the input file exists.
        if (!Storage::disk($this->inputDisk)->exists($inputFile)) {
            throw new \Exception("Input file not found.");
        }

        $inputFile = Storage::disk($this->inputDisk)->path($inputFile);

        $inputFormat = $this->getFormat(pathinfo($inputFile, PATHINFO_EXTENSION));

        // Check if the conversion is supported.
        if (!$this->isSupportedConversion($inputFormat, $toFormat)) {
            throw new \Exception("Conversion from $inputFormat to $toFormat is not supported.");
        }

        // Check mime type.
        if (!$this->isSupportedMimeType($inputFormat, File::mimeType($inputFile))) {
            throw new \Exception("Conversion from $inputFormat to $toFormat is not supported.");
        }

        return $inputFormat->convert($inputFile, $toFormat);
    }
}
