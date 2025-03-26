<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class RtfConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testRtfToPdfConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testRtfToDocxConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'docx');
        $this->assertTrue(Storage::disk('local')->exists('test.docx'));
    }

    public function testRtfToOdtConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'odt');
        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testRtfToTxtConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'txt');
        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }

    public function testRtfToHtmlConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }

    public function testRtfToXmlConversion()
    {
        Storage::disk('local')->put('test.rtf', file_get_contents(__DIR__ . '/../Stubs/sample.rtf'));
        $this->doxswap->convert('test.rtf', 'xml');
        $this->assertTrue(Storage::disk('local')->exists('test.xml'));
    }
}