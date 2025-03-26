<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class OdsConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testOdsToPdfConversion()
    {
        Storage::disk('local')->put('test.ods', file_get_contents(__DIR__ . '/../Stubs/sample.ods'));
        $this->doxswap->convert('test.ods', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testOdsToXlsxConversion()
    {
        Storage::disk('local')->put('test.ods', file_get_contents(__DIR__ . '/../Stubs/sample.ods'));
        $this->doxswap->convert('test.ods', 'xlsx');
        $this->assertTrue(Storage::disk('local')->exists('test.xlsx'));
    }

    public function testOdsToXlsConversion()
    {
        Storage::disk('local')->put('test.ods', file_get_contents(__DIR__ . '/../Stubs/sample.ods'));
        $this->doxswap->convert('test.ods', 'xls');
        $this->assertTrue(Storage::disk('local')->exists('test.xls'));
    }

    public function testOdsToCsvConversion()
    {
        Storage::disk('local')->put('test.ods', file_get_contents(__DIR__ . '/../Stubs/sample.ods'));
        $this->doxswap->convert('test.ods', 'csv');
        $this->assertTrue(Storage::disk('local')->exists('test.csv'));
    }

    public function testOdsToHtmlConversion()
    {
        Storage::disk('local')->put('test.ods', file_get_contents(__DIR__ . '/../Stubs/sample.ods'));
        $this->doxswap->convert('test.ods', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }
}
