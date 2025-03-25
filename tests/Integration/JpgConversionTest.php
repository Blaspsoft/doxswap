<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class JpgConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testJpgToPdfConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->converter->convert('test.jpg', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testJpgToPngConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->converter->convert('test.jpg', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testJpgToSvgConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->converter->convert('test.jpg', 'svg');
        $this->assertTrue(Storage::disk('local')->exists('test.svg'));
    }

    public function testJpgToTiffConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->converter->convert('test.jpg', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }

    public function testJpgToBmpConversion()
    {
        Storage::disk('local')->put('test.jpg', file_get_contents(__DIR__ . '/../Stubs/sample.jpg'));
        $this->converter->convert('test.jpg', 'bmp');
        $this->assertTrue(Storage::disk('local')->exists('test.bmp'));
    }
}