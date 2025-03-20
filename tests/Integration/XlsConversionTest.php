<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class XlsConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }

    public function testXlsToPdfConversion()
    {
        Storage::disk('local')->put('test.xls', file_get_contents(__DIR__ . '/../Stubs/sample.xls'));
        $this->converter->convert('test.xls', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testXlsToOdsConversion()
    {
        Storage::disk('local')->put('test.xls', file_get_contents(__DIR__ . '/../Stubs/sample.xls'));
        $this->converter->convert('test.xls', 'ods');
        $this->assertTrue(Storage::disk('local')->exists('test.ods'));
    }

    public function testXlsToCsvConversion()
    {
        Storage::disk('local')->put('test.xls', file_get_contents(__DIR__ . '/../Stubs/sample.xls'));
        $this->converter->convert('test.xls', 'csv');
        $this->assertTrue(Storage::disk('local')->exists('test.csv'));
    }

    public function testXlsToHtmlConversion()
    {
        Storage::disk('local')->put('test.xls', file_get_contents(__DIR__ . '/../Stubs/sample.xls'));
        $this->converter->convert('test.xls', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }
}