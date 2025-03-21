<?php

namespace Blaspsoft\Doxswap;

class ConversionResult
{
    /**
     * The input file.
     *
     * @var string
     */
    public string $inputFile;

    /**
     * The output file.
     *
     * @var string
     */
    public string $outputFile;

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
     * Create a new conversion result.
     *
     * @param string $inputFile
     * @param string $outputFile
     * @param string $toFormat
     * @param float $duration
     */
    public function __construct(string $inputFile, string $outputFile, string $toFormat, float $duration)
    {
        $this->inputFile = $inputFile;

        $this->outputFile = $outputFile;

        $this->toFormat = $toFormat;

        $this->duration = $this->formatDuration($duration);
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
