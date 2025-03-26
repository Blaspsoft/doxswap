<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DocxConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
    
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testDocxToPdfConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'pdf');

        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testDocxToOdtConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'odt');

        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testDocxToRtfConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'rtf');

        $this->assertTrue(Storage::disk('local')->exists('test.rtf'));
    }

    public function testDocxToTxtConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'txt');

        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }

    public function testDocxToHtmlConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'html');

        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }

    public function testDocxToEpubConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'epub');

        $this->assertTrue(Storage::disk('local')->exists('test.epub'));
    }

    public function testDocxToXmlConversion()
    {
        Storage::disk('local')->put('test.docx', file_get_contents(__DIR__ . '/../Stubs/sample.docx'));
        $this->doxswap->convert('test.docx', 'xml');

        $this->assertTrue(Storage::disk('local')->exists('test.xml'));
    }
}