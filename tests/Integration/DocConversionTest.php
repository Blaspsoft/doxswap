<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DocConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
    
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }

    public function testDocToPdfConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testDocToDocxConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'docx');
        $this->assertTrue(Storage::disk('local')->exists('test.docx'));
    }

    public function testDocToOdtConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'odt');
        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testDocToRtfConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'rtf');
        $this->assertTrue(Storage::disk('local')->exists('test.rtf'));
    }

    public function testDocToTxtConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'txt');
        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }

    public function testDocToHtmlConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }

    public function testDocToEpubConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'epub');
        $this->assertTrue(Storage::disk('local')->exists('test.epub'));
    }

    public function testDocToXmlConversion()
    {
        Storage::disk('local')->put('test.doc', file_get_contents(__DIR__ . '/../Stubs/sample.doc'));
        $this->doxswap->convert('test.doc', 'xml');
        $this->assertTrue(Storage::disk('local')->exists('test.xml'));
    }
}
