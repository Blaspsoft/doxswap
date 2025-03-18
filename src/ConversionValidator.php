<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Doxswap\Exceptions\InputFileNotFoundException;
use Blaspsoft\Doxswap\Exceptions\UnsupportedMimeTypeException;
use Blaspsoft\Doxswap\Exceptions\UnsupportedConversionException;

class ConversionValidator
{
    /**
     * The driver name.
     *
     * @var string
     */
    protected string $driver;

    /**
     * The supported conversions.
     *
     * @var array
     */
    protected $supportedConversions;

    /**
     * The supported mime types.
     *
     * @var array
     */
    protected $supportedMimeTypes;

    /**
     * Create a new ConversionValidator instance.
     *
     * @return void
     */
    public function __construct(string $driver)
    {
        $this->driver = $driver;

        $this->supportedConversions = config('doxswap.supported_conversions');
        
        $this->supportedMimeTypes = config('doxswap.supported_mime_types');
    }

    /**
     * Validate the conversion.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @return bool
     */
    public function validate(string $inputFile, string $outputFile): bool
    {
        $inputExtension = $this->getExtension($inputFile);

        $outputExtension = $this->getExtension($outputFile);

        if (!$this->inputFileExists($inputFile)) {
            throw new InputFileNotFoundException('Input file not found', $inputFile);
        }

        if (!$this->isSupportedConversion($inputExtension, $outputExtension)) {
            throw new UnsupportedConversionException('Conversion not supported', $this->driver);
        }

        if (!$this->isSupportedMimeType($inputExtension)) {
            throw new UnsupportedMimeTypeException('Input file mime type not supported', $this->driver);
        }

        return true;
    }

    /**
     * Get the extension of a file.
     *
     * @param string $file
     * @return string
     */
    protected function getExtension(string $file): string
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Check if the input file exists.
     *
     * @param string $inputFile
     * @return bool
     */
    protected function inputFileExists(string $inputFile): bool
    {
        return file_exists($inputFile);
    }

     /**
     * Check if the conversion is supported.
     *
     * @param string $inputExtension
     * @param string $outputExtension
     * @return bool
     */
    protected function isSupportedConversion(string $inputExtension , string $outputExtension): bool
    {
        return isset($this->supportedConversions[$inputExtension]) &&
               in_array($outputExtension, $this->supportedConversions[$inputExtension]);
    }

    /**
     * Check if the mime type is supported.
     *
     * @param string $mimeType
     * @return bool
     */
    protected function isSupportedMimeType(string $mimeType): bool
    {
        return in_array($mimeType, $this->supportedMimeTypes);
    }
}

