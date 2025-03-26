<?php

namespace Blaspsoft\Doxswap\Strategies;

use Imagick;
use Exception;
use Blaspsoft\Doxswap\Filename;
use Blaspsoft\Doxswap\ConversionResult;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\Exceptions\ConversionFailedException;

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
     * Supported formats for Imagick.
     *
     * @var array
     */
    protected array $supportedFormats = ['bmp', 'png', 'jpg', 'jpeg', 'svg', 'tiff', 'webp', 'gif'];

    /**
     * Create a new ImageMagickStrategy instance.
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');
        $this->outputDisk = config('doxswap.output_disk');
    }

    /**
     * Convert a file to a new format using Imagick.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     *
     * @throws \Exception
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): ConversionResult
    {
        if (!extension_loaded('imagick')) {
            throw new Exception('Imagick extension is not installed or enabled.');
        }

        if (!in_array(strtolower($fromFormat), $this->supportedFormats) || !in_array(strtolower($toFormat), $this->supportedFormats)) {
            throw new Exception("Conversion from $fromFormat to $toFormat is not supported by ImageMagick.");
        }

        $outputFile = Storage::disk($this->outputDisk)->path(str_replace($fromFormat, $toFormat, basename($inputFile)));

        $startTime = (float) microtime(true);
        
        try {
            $imagick = new Imagick();
            $imagick->readImage($inputFile);
            $imagick->setImageFormat($toFormat);
            $imagick->writeImage($outputFile);
            $imagick->clear();
            $imagick->destroy();
        } catch (Exception $e) {
            throw new ConversionFailedException("ImageMagick conversion failed: " . $e->getMessage());
        }

        $endTime = (float) microtime(true);

        if (!Storage::disk($this->outputDisk)->exists(basename($outputFile))) {
            throw new ConversionFailedException("Converted file was not created.");
        }

        $outputFile = Filename::rename($outputFile);

        return new ConversionResult(
            inputFilePath: $inputFile,
            outputFilePath: $outputFile,
            toFormat: $toFormat,
            startTime: $startTime,
            endTime: $endTime
        );
    }
}
