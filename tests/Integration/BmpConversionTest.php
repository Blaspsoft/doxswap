<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class BmpConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testBmpToPdfConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testBmpToJpgConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testBmpToPngConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testBmpToSvgConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testBmpToTiffConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testBmpToWebpConversion()   
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp'));
    }

    public function testBmpToGifConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->doxswap->convert('test.bmp', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }
}