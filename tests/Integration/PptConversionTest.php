<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PptConversionTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->doxswap = new Doxswap();
    }
    
    public function testPptToPdfConversion()
    {
        Storage::disk('local')->put('test.ppt', file_get_contents(__DIR__ . '/../Stubs/sample.ppt'));
        $this->doxswap->convert('test.ppt', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPptToOdpConversion()
    {
        Storage::disk('local')->put('test.ppt', file_get_contents(__DIR__ . '/../Stubs/sample.ppt'));
        $this->doxswap->convert('test.ppt', 'odp');
        $this->assertTrue(Storage::disk('local')->exists('test.odp'));
    }   
}    
    