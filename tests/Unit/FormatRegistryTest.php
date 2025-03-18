<?php

namespace Tests\Unit;

use Orchestra\Testbench\TestCase;
use Blaspsoft\Doxswap\FormatRegistry;
use Blaspsoft\Doxswap\Formats\DocFormat;
use Blaspsoft\Doxswap\Formats\DocxFormat;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Mockery;

class FormatRegistryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock any dependencies here if necessary
        // For example, if FormatRegistry depends on a config, you might do:
        // $this->app->instance('config', Mockery::mock(Config::class));
    }

    public function test_it_registers_formats()
    {
        $registry = new FormatRegistry();

        $this->assertCount(2, $registry->getFormats());
        $this->assertInstanceOf(DocFormat::class, $registry->getFormat('doc'));
        $this->assertInstanceOf(DocxFormat::class, $registry->getFormat('docx'));
    }

    public function test_it_checks_supported_conversion()
    {
        $registry = new FormatRegistry();

        $this->assertTrue($registry->isSupportedConversion('doc', 'pdf'));
        $this->assertFalse($registry->isSupportedConversion('doc', 'unknown'));
    }

    public function test_it_converts_file()
    {
        $registry = new FormatRegistry();
        $mockFormat = Mockery::mock(ConvertibleFormat::class);
        $mockFormat->shouldReceive('getName')->andReturn('mock');
        $mockFormat->shouldReceive('getSupportedConversions')->andReturn(['pdf']);
        $mockFormat->shouldReceive('convert')->andReturn('converted-file.pdf');

        $registry->register($mockFormat);

        $result = $registry->convert('file.mock', 'pdf');
        $this->assertEquals('converted-file.pdf', $result);
    }
}