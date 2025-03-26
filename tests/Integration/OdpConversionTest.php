<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class OdpConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testOdpToPdfConversion()
    {
        Storage::disk('local')->put('test.odp', file_get_contents(__DIR__ . '/../Stubs/sample.odp'));
        $this->doxswap->convert('test.odp', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testOdpToPptxConversion()
    {
        Storage::disk('local')->put('test.odp', file_get_contents(__DIR__ . '/../Stubs/sample.odp'));
        $this->doxswap->convert('test.odp', 'pptx');
        $this->assertTrue(Storage::disk('local')->exists('test.pptx'));
    }

    public function testOdpToPptConversion()
    {
        Storage::disk('local')->put('test.odp', file_get_contents(__DIR__ . '/../Stubs/sample.odp'));
        $this->doxswap->convert('test.odp', 'ppt');
        $this->assertTrue(Storage::disk('local')->exists('test.ppt'));
    }
}