<?php

namespace Blaspsoft\Doxswap;

class ConversionValidator
{
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
    public function __construct(string$driver)
    {
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
            throw new \Exception('Input file not found');
        }

        if (!$this->isSupportedConversion($inputExtension, $outputExtension)) {
            throw new \Exception('Conversion not supported');
        }

        if (!$this->isSupportedMimeType($inputExtension)) {
            throw new \Exception('Input file mime type not supported');
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

