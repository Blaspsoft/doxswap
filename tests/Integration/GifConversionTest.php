<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class GifConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testGifToPdfConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }   

    public function testGifToPngConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }   

    public function testGifToJpgConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }   

    public function testGifToTiffConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff')); 
    }

    public function testGifToBmpConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp')); 
    }

    public function testGifToWebpConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp')); 
    }

    public function testGifToSvgConversion()
    {
        Storage::disk('local')->put('test.gif', file_get_contents(__DIR__ . '/../Stubs/sample.gif'));
        $this->doxswap->convert('test.gif', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }
}
