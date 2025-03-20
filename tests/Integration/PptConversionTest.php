<?php

namespace Blaspsoft\Doxswap\Tests\Integration;

use Blaspsoft\Doxswap\Converter;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PptConversionTest extends TestCase
{
    protected Converter $converter;

    protected function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('local');

        $this->converter = new Converter();
    }
    
    public function testPptToPdfConversion()
    {
        Storage::disk('local')->put('test.ppt', file_get_contents(__DIR__ . '/../Stubs/sample.ppt'));
        $this->converter->convert('test.ppt', 'pdf');
        $this->assertTrue(Storage::disk('local')->exists('test.pdf'));
    }

    public function testPptToOdpConversion()
    {
        Storage::disk('local')->put('test.ppt', file_get_contents(__DIR__ . '/../Stubs/sample.ppt'));
        $this->converter->convert('test.ppt', 'odp');
        $this->assertTrue(Storage::disk('local')->exists('test.odp'));
    }   
}    
    