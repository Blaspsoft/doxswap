<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class HtmlConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->converter = new Converter();
    }

    public function testHtmlToPdfConversion()
    {
        Storage::disk('local')->put('test.html', file_get_contents(__DIR__ . '/../Stubs/sample.html'));
        $this->converter->convert('test.html', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testHtmlToOdtConversion()
    {
        Storage::disk('local')->put('test.html', file_get_contents(__DIR__ . '/../Stubs/sample.html'));
        $this->converter->convert('test.html', 'odt');
        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testHtmlToTxtConversion()
    {
        Storage::disk('local')->put('test.html', file_get_contents(__DIR__ . '/../Stubs/sample.html'));
        $this->converter->convert('test.html', 'txt');
        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }
}