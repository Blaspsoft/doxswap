<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class XlsxConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testXlsxToPdfConversion()
    {
        Storage::disk('local')->put('test.xlsx', file_get_contents(__DIR__ . '/../Stubs/sample.xlsx'));
        $this->converter->convert('test.xlsx', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testXlsxToOdsConversion()
    {
        Storage::disk('local')->put('test.xlsx', file_get_contents(__DIR__ . '/../Stubs/sample.xlsx'));
        $this->converter->convert('test.xlsx', 'ods');
        $this->assertTrue(Storage::disk('local')->exists('test.ods'));
    }

    public function testXlsxToCsvConversion()
    {
        Storage::disk('local')->put('test.xlsx', file_get_contents(__DIR__ . '/../Stubs/sample.xlsx'));
        $this->converter->convert('test.xlsx', 'csv');
        $this->assertTrue(Storage::disk('local')->exists('test.csv'));
    }

    public function testXlsxToHtmlConversion()
    {
        Storage::disk('local')->put('test.xlsx', file_get_contents(__DIR__ . '/../Stubs/sample.xlsx'));
        $this->converter->convert('test.xlsx', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }
}