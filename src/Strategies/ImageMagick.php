<?php

namespace Blaspsoft\Doxswap\Strategies;

use Imagick;
use Blaspsoft\Doxswap\Filename;
use Blaspsoft\Doxswap\ConversionResult;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\Exceptions\ConversionFailedException;
use Blaspsoft\Doxswap\Exceptions\ImagickExtensionNotFoundException;

class ImageMagick implements ConversionStrategy
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
     * The filename service.
     *
     * @var \Blaspsoft\Doxswap\Filename
     */
    protected Filename $filename;

    /**
     * Supported formats for Imagick.
     *
     * @var array
     */
    protected array $supportedFormats = ['bmp', 'png', 'jpg', 'jpeg', 'svg', 'tiff', 'webp', 'gif'];

    /**
     * Create a new ImageMagick instance.
     *
     * @param string $inputDisk
     * @param string $outputDisk
     * @param \Blaspsoft\Doxswap\Filename $filename
     */
    public function __construct(string $inputDisk, string $outputDisk, Filename $filename)
    {
        $this->inputDisk = $inputDisk;
        $this->outputDisk = $outputDisk;
        $this->filename = $filename;
    }

    /**
     * Convert a file to a new format using Imagick.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): ConversionResult
    {
        if (!extension_loaded('imagick')) {
            throw new ImagickExtensionNotFoundException();
        }

        if (!in_array(strtolower($fromFormat), $this->supportedFormats) || !in_array(strtolower($toFormat), $this->supportedFormats)) {
            throw new ConversionFailedException("Conversion from $fromFormat to $toFormat is not supported by ImageMagick.");
        }

        $outputFile = Storage::disk($this->outputDisk)->path(pathinfo($inputFile, PATHINFO_FILENAME) . '.' . $toFormat);

        $startTime = (float) microtime(true);

        try {
            $imagick = new Imagick();
            $imagick->readImage($inputFile);
            $imagick->setImageFormat($toFormat);
            $imagick->writeImage($outputFile);
            $imagick->clear();
            $imagick->destroy();
        } catch (\Exception $e) {
            throw new ConversionFailedException("ImageMagick conversion failed: " . $e->getMessage(), 0, $e);
        }

        $endTime = (float) microtime(true);

        if (!Storage::disk($this->outputDisk)->exists(basename($outputFile))) {
            throw new ConversionFailedException("Converted file was not created.");
        }

        $outputFile = $this->filename->rename($outputFile);

        return new ConversionResult(
            inputFilePath: $inputFile,
            outputFilePath: $outputFile,
            toFormat: $toFormat,
            startTime: $startTime,
            endTime: $endTime,
            inputDisk: $this->inputDisk,
            outputDisk: $this->outputDisk
        );
    }
}
