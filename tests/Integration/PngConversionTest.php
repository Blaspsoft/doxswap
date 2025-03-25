<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PngConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testPngToPdfConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->converter->convert('test.png', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPngToJpgConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->converter->convert('test.png', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testPngToSvgConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->converter->convert('test.png', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testPngToTiffConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->converter->convert('test.png', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testPngToBmpConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->converter->convert('test.png', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }
}