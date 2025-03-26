<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class JpgConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testJpgToPdfConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testJpgToPngConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testJpgToSvgConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testJpgToTiffConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testJpgToBmpConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }

    public function testJpgToWebpConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'webp');
        $this->assertTrue(Storage::disk('local')->exists('test.webp')); 
    }

    public function testJpgToGifConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->doxswap->convert('test.jpg', 'gif');
        $this->assertTrue(Storage::disk('local')->exists('test.gif'));
    }
}