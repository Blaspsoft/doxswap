<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class WebpConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testWebpToPdfConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testWebpToPngConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testWebpToJpgConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testWebpToTiffConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testWebpToBmpConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }

    public function testWebpToGifConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }

    public function testWebpToSvgConversion()
    {
        Storage::disk('local')->put('test.webp', file_get_contents(__DIR__ . '/../Stubs/sample.webp'));
        $this->doxswap->convert('test.webp', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }
}