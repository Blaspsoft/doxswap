<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PngConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testPngToPdfConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPngToJpgConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testPngToSvgConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testPngToTiffConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testPngToBmpConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }

    public function testPngToWebpConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp')); 
    }

    public function testPngToGifConversion()
    {
        Storage::disk('local')->put('test.png', file_get_contents(__DIR__ . '/../Stubs/sample.png'));
        $this->doxswap->convert('test.png', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }   
}