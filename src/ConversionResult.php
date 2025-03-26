<?php

namespace Blaspsoft\Doxswap;

class ConversionResult
{
    /**
     * The input filename.
     *
     * @var string
     */
    public string $inputFilename;

    /**
     * The input file.
     *
     * @var string
     */
    public string $inputFilePath;

    /** 
     * The output filename.
     *
     * @var string
     */
    public string $outputFilename;

    /**
     * The output file.
     *
     * @var string
     */
    public string $outputFilePath;

    /**
     * The format to convert the file to.
     *
     * @var string
     */
    public string $toFormat;

    /**
     * The duration of the conversion.
     *
     * @var string
     */
    public string $duration;

    /**
     * The start time of the conversion.
     *
     * @var float
     */
    public float $startTime;

    /**
     * The end time of the conversion.
     *
     * @var float
     */
    public float $endTime;

    /**
     * The input disk.
     *
     * @var string
     */
    public string $inputDisk;

    /**
     * The output disk.
     *
     * @var string
     */
    public string $outputDisk;

    /**
     * Create a new conversion result.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @param string $toFormat
     * @param float $startTime
     * @param float $endTime
     */
    public function __construct(
        string $inputFilePath, 
        string $outputFilePath, 
        string $toFormat, 
        float $startTime,
        float $endTime
    ) {
        $this->inputDisk = config('doxswap.input_disk');
        $this->outputDisk = config('doxswap.output_disk');
        $this->inputFilename = basename($inputFilePath);
        $this->inputFilePath = $inputFilePath;
        $this->outputFilename = basename($outputFilePath);
        $this->outputFilePath = $outputFilePath;
        $this->toFormat = $toFormat;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->duration = $this->formatDuration($endTime - $startTime);
    }

    /**
     * Format the duration of the conversion.
     *
     * @param float $seconds
     * @return string
     */
    protected function formatDuration(float $seconds): string
    {
        if ($seconds < 1) {
            return round($seconds * 1000) . ' ms';
        }

        return round($seconds, 2) . ' sec';
    }
}
