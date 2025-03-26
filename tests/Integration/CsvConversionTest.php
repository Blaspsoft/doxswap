<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class CsvConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testCsvToPdfConversion()
    {
        Storage::disk('local')->put('test.csv', file_get_contents(__DIR__ . '/../Stubs/sample.csv'));

        $this->doxswap->convert('test.csv', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }
    
    public function testCsvToXlsxConversion()
    {
        Storage::disk('local')->put('test.csv', file_get_contents(__DIR__ . '/../Stubs/sample.csv'));
        $this->doxswap->convert('test.csv', 'xlsx');
        $this->assertTrue(Storage::disk('local')->exists('test.xlsx'));
    }

    public function testCsvToOdsConversion()
    {
        Storage::disk('local')->put('test.csv', file_get_contents(__DIR__ . '/../Stubs/sample.csv'));
        $this->doxswap->convert('test.csv', 'ods');
        $this->assertTrue(Storage::disk('local')->exists('test.ods'));
    }

    public function testCsvToHtmlConversion()
    {
        Storage::disk('local')->put('test.csv', file_get_contents(__DIR__ . '/../Stubs/sample.csv'));
        $this->doxswap->convert('test.csv', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }
}