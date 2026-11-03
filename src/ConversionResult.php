<?php

namespace Blaspsoft\Doxswap;

class ConversionResult
{
    public readonly string $inputFilename;

    public readonly string $inputFilePath;

    public readonly string $outputFilename;

    public readonly string $outputFilePath;

    public readonly string $toFormat;

    public readonly string $duration;

    public readonly float $startTime;

    public readonly float $endTime;

    public readonly string $inputDisk;

    public readonly string $outputDisk;

    /**
     * Create a new conversion result.
     *
     * @param string $inputFilePath
     * @param string $outputFilePath
     * @param string $toFormat
     * @param float $startTime
     * @param float $endTime
     * @param string $inputDisk
     * @param string $outputDisk
     */
    public function __construct(
        string $inputFilePath,
        string $outputFilePath,
        string $toFormat,
        float $startTime,
        float $endTime,
        string $inputDisk,
        string $outputDisk
    ) {
        $this->inputDisk = $inputDisk;
        $this->outputDisk = $outputDisk;
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
