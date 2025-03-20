<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class OdtConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testOdtToPdfConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testOdtToDocxConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'docx');
        $this->assertTrue(Storage::disk('local')->exists('test.docx'));
    }

    public function testOdtToDocConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'doc');
        $this->assertTrue(Storage::disk('local')->exists('test.doc'));
    }

    public function testOdtToTxtConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'txt');
        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }

    public function testOdtToHtmlConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }

    public function testOdtToXmlConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'xml');
        $this->assertTrue(Storage::disk('local')->exists('test.xml'));
    }

    public function testOdtToRtfConversion()
    {
        Storage::disk('local')->put('test.odt', file_get_contents(__DIR__ . '/../Stubs/sample.odt'));
        $this->converter->convert('test.odt', 'rtf');
        $this->assertTrue(Storage::disk('local')->exists('test.rtf'));
    }
}