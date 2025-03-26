<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class SvgConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testSvgToPdfConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testSvgToPngConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testSvgToJpgConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testSvgToTiffConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testSvgToBmpConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }

    public function testSvgToWebpConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp'));
    }

    public function testSvgToGifConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->doxswap->convert('test.svg', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }
}