<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class TiffConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testTiffToPdfConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testTiffToPngConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testTiffToJpgConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testTiffToSvgConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testTiffToBmpConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }

    public function testTiffToWebpConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp'));
    }

    public function testTiffToGifConversion()
    {
        Storage::disk('local')->put('test.tiff', file_get_contents(__DIR__ . '/../Stubs/sample.tiff'));
        $this->doxswap->convert('test.tiff', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }
}