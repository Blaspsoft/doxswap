<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class SvgConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testSvgToPdfConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->converter->convert('test.svg', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testSvgToPngConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->converter->convert('test.svg', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }

    public function testSvgToJpgConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->converter->convert('test.svg', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testSvgToTiffConversion()
    {
        Storage::disk('local')->put('test.svg', file_get_contents(__DIR__ . '/../Stubs/sample.svg'));
        $this->converter->convert('test.svg', 'tiff');
        $this->assertTrue(Storage::disk('local')->exists('test.tiff'));
    }
}