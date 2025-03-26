<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Formats\BmpFormat;
use Blaspsoft\Doxswap\Formats\CsvFormat;
use Blaspsoft\Doxswap\Formats\DocFormat;
use Blaspsoft\Doxswap\Formats\JpgFormat;
use Blaspsoft\Doxswap\Formats\OdpFormat;
use Blaspsoft\Doxswap\Formats\OdsFormat;
use Blaspsoft\Doxswap\Formats\OdtFormat;
use Blaspsoft\Doxswap\Formats\PngFormat;
use Blaspsoft\Doxswap\Formats\PptFormat;
use Blaspsoft\Doxswap\Formats\RtfFormat;
use Blaspsoft\Doxswap\Formats\SvgFormat;
use Blaspsoft\Doxswap\Formats\TxtFormat;
use Blaspsoft\Doxswap\Formats\XlsFormat;
use Blaspsoft\Doxswap\Formats\XmlFormat;
use Blaspsoft\Doxswap\Formats\DocxFormat;
use Blaspsoft\Doxswap\Formats\HtmlFormat;
use Blaspsoft\Doxswap\Formats\PptxFormat;
use Blaspsoft\Doxswap\Formats\XlsxFormat;
use Blaspsoft\Doxswap\Formats\TiffFormat;
use Blaspsoft\Doxswap\Formats\GifFormat;
use Blaspsoft\Doxswap\Formats\WebpFormat;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
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
     * @return void
     */
    public function __construct()
    {
        $this->inputDisk = config('doxswap.input_disk');

        $this->register(new DocFormat());

        $this->register(new DocxFormat());

        $this->register(new OdtFormat());

        $this->register(new RtfFormat());

        $this->register(new TxtFormat());

        $this->register(new HtmlFormat());

        $this->register(new XmlFormat());

        $this->register(new XlsFormat());

        $this->register(new XlsxFormat());

        $this->register(new OdsFormat());

        $this->register(new PptxFormat());

        $this->register(new PptFormat());

        $this->register(new OdpFormat());

        $this->register(new SvgFormat());

        $this->register(new JpgFormat());

        $this->register(new PngFormat());

        $this->register(new BmpFormat());

        $this->register(new CsvFormat());

        $this->register(new TiffFormat());

        $this->register(new GifFormat());

        $this->register(new WebpFormat());
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
