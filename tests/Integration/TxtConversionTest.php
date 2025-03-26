<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class TxtConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testTxtToPdfConversion()
    {
        Storage::disk('local')->put('test.txt', file_get_contents(__DIR__ . '/../Stubs/sample.txt'));
        $this->doxswap->convert('test.txt', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testTxtToDocxConversion()
    {
        Storage::disk('local')->put('test.txt', file_get_contents(__DIR__ . '/../Stubs/sample.txt'));
        $this->doxswap->convert('test.txt', 'docx');
        $this->assertTrue(Storage::disk('local')->exists('test.docx'));
    }

    public function testTxtToOdtConversion()
    {
        Storage::disk('local')->put('test.txt', file_get_contents(__DIR__ . '/../Stubs/sample.txt'));
        $this->doxswap->convert('test.txt', 'odt');
        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testTxtToHtmlConversion()
    {
        Storage::disk('local')->put('test.txt', file_get_contents(__DIR__ . '/../Stubs/sample.txt'));
        $this->doxswap->convert('test.txt', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }

    public function testTxtToXmlConversion()
    {
        Storage::disk('local')->put('test.txt', file_get_contents(__DIR__ . '/../Stubs/sample.txt'));
        $this->doxswap->convert('test.txt', 'xml');
        $this->assertTrue(Storage::disk('local')->exists('test.xml'));
    }
}