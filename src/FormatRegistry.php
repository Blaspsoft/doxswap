<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Exceptions\FormatNotFoundException;
use Blaspsoft\Doxswap\Exceptions\InputFileNotFoundException;
use Blaspsoft\Doxswap\Exceptions\UnsupportedMimeTypeException;
use Blaspsoft\Doxswap\Exceptions\UnsupportedConversionException;

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
     * @param string $inputDisk
     * @param array $formats
     */
    public function __construct(string $inputDisk, array $formats = [])
    {
        $this->inputDisk = $inputDisk;

        foreach ($formats as $format) {
            $this->register($format);
        }
    }

    /**
     * Register a format.
     *
     * @param \Blaspsoft\Doxswap\Contracts\ConvertibleFormat $format
     * @return void
     */
    public function register(ConvertibleFormat $format): void
    {
        $this->formats[strtolower($format->getName())] = $format;
    }

    /**
     * Get a format by name.
     *
     * @param string $name
     * @return \Blaspsoft\Doxswap\Contracts\ConvertibleFormat
     * @throws \Blaspsoft\Doxswap\Exceptions\FormatNotFoundException
     */
    public function getFormat(string $name): ConvertibleFormat
    {
        $name = strtolower($name);

        if (!isset($this->formats[$name])) {
            throw new FormatNotFoundException($name);
        }

        return $this->formats[$name];
    }

    /**
     * Get all formats.
     *
     * @return array
     */
    public function getAllFormats(): array
    {
        return $this->formats;
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
        return in_array(strtolower($outputFormat), array_map('strtolower', $inputFormat->getSupportedConversions()));
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
        return in_array($mimeType, $format->getMimeTypes());
    }

    /**
     * Detect the mime type of a zip file.
     *
     * @param string $inputFile
     * @return string
     */
    protected function detectZipBasedMimeType(string $inputFile): string
    {
        $zip = new \ZipArchive();

        if ($zip->open($inputFile) === TRUE) {
            $mimetype = $zip->getFromName('mimetype');
            $zip->close();

            if ($mimetype !== false) {
                return trim($mimetype);
            }
        }

        return "application/zip";
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     * @throws \Blaspsoft\Doxswap\Exceptions\InputFileNotFoundException
     * @throws \Blaspsoft\Doxswap\Exceptions\UnsupportedConversionException
     * @throws \Blaspsoft\Doxswap\Exceptions\UnsupportedMimeTypeException
     */
    public function convert(string $inputFile, string $toFormat): ConversionResult
    {
        $toFormat = strtolower($toFormat);

        if (!Storage::disk($this->inputDisk)->exists($inputFile)) {
            throw new InputFileNotFoundException($inputFile);
        }

        $inputFile = Storage::disk($this->inputDisk)->path($inputFile);

        $inputFormat = $this->getFormat(pathinfo($inputFile, PATHINFO_EXTENSION));

        if (!$this->isSupportedConversion($inputFormat, $toFormat)) {
            throw new UnsupportedConversionException($inputFormat->getName(), $toFormat);
        }

        $mimeType = File::mimeType($inputFile);

        if ($mimeType === 'application/zip') {
            $mimeType = $this->detectZipBasedMimeType($inputFile);
        }

        if (!$this->isSupportedMimeType($inputFormat, $mimeType)) {
            throw new UnsupportedMimeTypeException($inputFormat->getName(), $toFormat);
        }

        return $inputFormat->convert($inputFile, $toFormat);
    }
}
