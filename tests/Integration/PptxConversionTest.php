<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PptxConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testPptxToPdfConversion()
    {
        Storage::disk('local')->put('test.pptx', file_get_contents(__DIR__ . '/../Stubs/sample.pptx'));
        $this->doxswap->convert('test.pptx', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPptxToOdpConversion()
    {
        Storage::disk('local')->put('test.pptx', file_get_contents(__DIR__ . '/../Stubs/sample.pptx'));
        $this->doxswap->convert('test.pptx', 'odp');
        $this->assertTrue(Storage::disk('local')->exists('test.odp'));
    }
}
