<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class TiffConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testTiffToPdfConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->converter->convert('test.tiff', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testTiffToPngConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->converter->convert('test.tiff', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testTiffToJpgConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->converter->convert('test.tiff', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }
}