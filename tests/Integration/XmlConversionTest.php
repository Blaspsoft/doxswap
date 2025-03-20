<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class XmlConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }

    public function testXmlToPdfConversion()
    {
        Storage::disk('local')->put('test.xml', file_get_contents(__DIR__ . '/../Stubs/sample.xml'));
        $this->converter->convert('test.xml', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testXmlToOdtConversion()
    {
        Storage::disk('local')->put('test.xml', file_get_contents(__DIR__ . '/../Stubs/sample.xml'));
        $this->converter->convert('test.xml', 'odt');
        $this->assertTrue(Storage::disk('local')->exists('test.odt'));
    }

    public function testXmlToTxtConversion()
    {
        Storage::disk('local')->put('test.xml', file_get_contents(__DIR__ . '/../Stubs/sample.xml'));
        $this->converter->convert('test.xml', 'txt');
        $this->assertTrue(Storage::disk('local')->exists('test.txt'));
    }

    public function testXmlToHtmlConversion()
    {
        Storage::disk('local')->put('test.xml', file_get_contents(__DIR__ . '/../Stubs/sample.xml'));
        $this->converter->convert('test.xml', 'html');
        $this->assertTrue(Storage::disk('local')->exists('test.html'));
    }    
}