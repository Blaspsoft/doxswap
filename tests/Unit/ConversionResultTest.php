<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Blaspsoft\Doxswap\ConversionResult;
use PHPUnit\Framework\TestCase;

class ConversionResultTest extends TestCase
{
    public function testReadonlyProperties()
    {
        $result = new ConversionResult(
            inputFilePath: '/path/to/input.docx',
            outputFilePath: '/path/to/output.pdf',
            toFormat: 'pdf',
            startTime: 1000.0,
            endTime: 1002.5,
            inputDisk: 'input-disk',
            outputDisk: 'output-disk'
        );

        $this->assertEquals('input.docx', $result->inputFilename);
        $this->assertEquals('/path/to/input.docx', $result->inputFilePath);
        $this->assertEquals('output.pdf', $result->outputFilename);
        $this->assertEquals('/path/to/output.pdf', $result->outputFilePath);
        $this->assertEquals('pdf', $result->toFormat);
        $this->assertEquals(1000.0, $result->startTime);
        $this->assertEquals(1002.5, $result->endTime);
        $this->assertEquals('input-disk', $result->inputDisk);
        $this->assertEquals('output-disk', $result->outputDisk);
    }

    public function testPropertiesCannotBeModified()
    {
        $result = new ConversionResult(
            inputFilePath: '/path/to/input.docx',
            outputFilePath: '/path/to/output.pdf',
            toFormat: 'pdf',
            startTime: 1000.0,
            endTime: 1002.5,
            inputDisk: 'local',
            outputDisk: 'local'
        );

        $this->expectException(\Error::class);

        $result->toFormat = 'docx';
    }

    public function testFormatDurationSeconds()
    {
        $result = new ConversionResult(
            inputFilePath: '/path/to/input.docx',
            outputFilePath: '/path/to/output.pdf',
            toFormat: 'pdf',
            startTime: 1000.0,
            endTime: 1002.5,
            inputDisk: 'local',
            outputDisk: 'local'
        );

        $this->assertEquals('2.5 sec', $result->duration);
    }

    public function testFormatDurationMilliseconds()
    {
        $result = new ConversionResult(
            inputFilePath: '/path/to/input.docx',
            outputFilePath: '/path/to/output.pdf',
            toFormat: 'pdf',
            startTime: 1000.0,
            endTime: 1000.5,
            inputDisk: 'local',
            outputDisk: 'local'
        );

        $this->assertEquals('500 ms', $result->duration);
    }
}
