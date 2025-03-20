<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PptxConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testPptxToPdfConversion()
    {
        Storage::disk('local')->put('test.pptx', file_get_contents(__DIR__ . '/../Stubs/sample.pptx'));
        $this->converter->convert('test.pptx', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPptxToOdpConversion()
    {
        Storage::disk('local')->put('test.pptx', file_get_contents(__DIR__ . '/../Stubs/sample.pptx'));
        $this->converter->convert('test.pptx', 'odp');
        $this->assertTrue(Storage::disk('local')->exists('test.odp'));
    }
}
