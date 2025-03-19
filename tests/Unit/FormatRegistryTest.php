<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\File;
use Blaspsoft\Doxswap\FormatRegistry;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Formats\DocFormat;
use Blaspsoft\Doxswap\Formats\DocxFormat;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;

class FormatRegistryTest extends TestCase
{
    protected FormatRegistry $formatRegistry;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the configuration for the input disk
        Config::set('doxswap.input_disk', 'local');

        // Mock the storage disk
        Storage::fake('local');

        $this->formatRegistry = new FormatRegistry();
    }

    public function testRegisterFormat()
    {
        $mockFormat = $this->createMock(ConvertibleFormat::class);
        $mockFormat->method('getName')->willReturn('mock');
        
        $this->formatRegistry->register($mockFormat);
        
        $this->assertSame($mockFormat, $this->formatRegistry->getFormat('mock'));
    }

    public function testGetFormat()
    {
        $format = $this->formatRegistry->getFormat('doc');
        $this->assertInstanceOf(DocFormat::class, $format);
    }

    public function testIsSupportedConversion()
    {
        $docFormat = new DocFormat();
        $this->assertTrue($this->formatRegistry->isSupportedConversion($docFormat, 'pdf'));
    }

    public function testIsSupportedMimeType()
    {
        $docFormat = new DocFormat();
        $this->assertTrue($this->formatRegistry->isSupportedMimeType($docFormat, 'application/msword'));
    }

    public function testConvertThrowsExceptionForNonExistentFile()
    {
        $this->expectException(\Blaspsoft\Doxswap\Exceptions\InputFileNotFoundException::class);
        $this->expectExceptionMessage('Input file not found: nonexistent.doc');

        $this->formatRegistry->convert('nonexistent.doc', 'pdf');
    }

    public function testConvertThrowsExceptionForUnsupportedConversion()
    {
        Storage::disk('local')->put('test.doc', 'dummy content');

        $this->expectException(\Blaspsoft\Doxswap\Exceptions\UnsupportedConversionException::class);
        $this->expectExceptionMessage("Conversion from 'doc' to 'unknown' is not supported");

        $this->formatRegistry->convert('test.doc', 'unknown');
    }

    public function testConvertThrowsExceptionForUnsupportedMimeType()
    {
        Storage::disk('local')->put('test.doc', 'dummy content');

        $this->expectException(\Blaspsoft\Doxswap\Exceptions\UnsupportedMimeTypeException::class);
        $this->expectExceptionMessage("Unsupported MIME type for extension: doc");

        File::shouldReceive('mimeType')->andReturn('invalid/mime-type');
        $this->formatRegistry->convert('test.doc', 'pdf');
    }
}