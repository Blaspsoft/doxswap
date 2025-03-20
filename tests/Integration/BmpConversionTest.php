<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class BmpConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->converter = new Converter();
    }

    public function testBmpToPdfConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->converter->convert('test.bmp', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testBmpToJpgConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->converter->convert('test.bmp', 'jpg');
        $this->assertTrue(Storage::disk('local')->exists('test.jpg'));
    }

    public function testBmpToPngConversion()
    {
        Storage::disk('local')->put('test.bmp', file_get_contents(__DIR__ . '/../Stubs/sample.bmp'));
        $this->converter->convert('test.bmp', 'png');
        $this->assertTrue(Storage::disk('local')->exists('test.png'));
    }
}