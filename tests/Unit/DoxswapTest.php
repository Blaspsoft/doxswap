<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Mockery;
use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\FormatRegistry;
use Blaspsoft\Doxswap\Tests\TestCase;
use Blaspsoft\Doxswap\ConversionResult;
use Blaspsoft\Doxswap\ConversionCleanup;
use Blaspsoft\Doxswap\Facades\Doxswap as DoxswapFacade;

class DoxswapTest extends TestCase
{
    protected Doxswap $doxswap;

    protected function setUp(): void
    {
        parent::setUp();

        $this->doxswap = $this->app->make('doxswap');
    }

    public function testSupportsReturnsTrueForValidConversion()
    {
        $this->assertTrue($this->doxswap->supports('docx', 'pdf'));
    }

    public function testSupportsReturnsFalseForInvalidConversion()
    {
        $this->assertFalse($this->doxswap->supports('docx', 'mp3'));
    }

    public function testSupportsReturnsFalseForUnknownFormat()
    {
        $this->assertFalse($this->doxswap->supports('unknown', 'pdf'));
    }

    public function testSupportedFormatsReturnsArray()
    {
        $formats = $this->doxswap->supportedFormats();

        $this->assertIsArray($formats);
        $this->assertContains('docx', $formats);
        $this->assertContains('png', $formats);
        $this->assertContains('jpg', $formats);
    }

    public function testSupportedFormatsContainsAllFormats()
    {
        $formats = $this->doxswap->supportedFormats();

        $this->assertCount(21, $formats);
    }

    public function testConvertCleansUpTheNestedInputPath()
    {
        $result = new ConversionResult('/disk/reports/input.docx', '/disk/input.pdf', 'pdf', 1.0, 2.0, 'local', 'local');

        $registry = Mockery::mock(FormatRegistry::class);
        $registry->shouldReceive('convert')->once()->with('reports/input.docx', 'pdf')->andReturn($result);

        $cleanup = Mockery::mock(ConversionCleanup::class);
        $cleanup->shouldReceive('cleanup')->once()->with('reports/input.docx');

        (new Doxswap($registry, $cleanup))->convert('reports/input.docx', 'pdf');
    }

    public function testFacadeResolvesAFreshInstanceOnEachCall()
    {
        DoxswapFacade::supportedFormats();
        $first = DoxswapFacade::getFacadeRoot();

        DoxswapFacade::supportedFormats();

        $this->assertNotSame($first, DoxswapFacade::getFacadeRoot());
    }
}
