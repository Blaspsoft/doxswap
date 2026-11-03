<?php

namespace Blaspsoft\Doxswap\Strategies;

use Blaspsoft\Doxswap\Filename;
use Symfony\Component\Process\Process;
use Blaspsoft\Doxswap\ConversionResult;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;
use Blaspsoft\Doxswap\Exceptions\ConversionFailedException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

class LibreOffice implements ConversionStrategy
{
    /**
     * The path to the LibreOffice binary.
     *
     * @var string
     */
    protected string $path;

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
     * The process timeout in seconds, or null for no limit.
     *
     * @var int|null
     */
    protected ?int $timeout;

    /**
     * Create a new LibreOffice instance.
     *
     * @param string $path
     * @param string $inputDisk
     * @param string $outputDisk
     * @param \Blaspsoft\Doxswap\Filename $filename
     * @param int|null $timeout
     */
    public function __construct(string $path, string $inputDisk, string $outputDisk, Filename $filename, ?int $timeout = 120)
    {
        $this->path = $path;
        $this->inputDisk = $inputDisk;
        $this->outputDisk = $outputDisk;
        $this->filename = $filename;
        $this->timeout = $timeout;
    }

    /**
     * Convert a file to a new format.
     *
     * @param string $inputFile
     * @param string $fromFormat
     * @param string $toFormat
     * @return \Blaspsoft\Doxswap\ConversionResult
     */
    public function convert(string $inputFile, string $fromFormat, string $toFormat): ConversionResult
    {
        $outputFile = Storage::disk($this->outputDisk)->path(pathinfo($inputFile, PATHINFO_FILENAME) . '.' . $toFormat);

        $startTime = (float) microtime(true);

        $command = [
            $this->path,
            '--headless',
            '--convert-to', $toFormat,
            '--outdir', Storage::disk($this->outputDisk)->path(''),
            $inputFile,
        ];

        $process = new Process($command);
        $process->setTimeout($this->timeout);

        try {
            $process->run();
        } catch (ProcessTimedOutException $e) {
            throw new ConversionFailedException(
                "LibreOffice conversion timed out after {$this->timeout} seconds.",
                0,
                $e
            );
        }

        $endTime = (float) microtime(true);

        if (!$process->isSuccessful()) {
            throw new ConversionFailedException(
                "LibreOffice conversion failed: " . $process->getErrorOutput(),
                0,
                new ProcessFailedException($process)
            );
        }

        if (!Storage::disk($this->outputDisk)->exists(basename($outputFile))) {
            throw new ConversionFailedException("LibreOffice conversion produced no output file.");
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
