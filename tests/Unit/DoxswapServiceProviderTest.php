<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use ReflectionProperty;
use Blaspsoft\Doxswap\FormatRegistry;
use Blaspsoft\Doxswap\Tests\TestCase;
use Blaspsoft\Doxswap\Formats\PngFormat;
use Blaspsoft\Doxswap\Strategies\ImageMagick;
use Blaspsoft\Doxswap\Strategies\LibreOffice;

class DoxswapServiceProviderTest extends TestCase
{
    protected function property(object $object, string $name): mixed
    {
        return (new ReflectionProperty($object, $name))->getValue($object);
    }

    public function testConfigChangesApplyAfterFirstResolve()
    {
        $this->app->make(FormatRegistry::class);

        config(['doxswap.input_disk' => 'other']);

        $this->assertSame('other', $this->property($this->app->make(FormatRegistry::class), 'inputDisk'));
    }

    public function testProcessTimeoutDefaultsTo120()
    {
        $this->assertSame(120, $this->property($this->app->make(LibreOffice::class), 'timeout'));
    }

    public function testProcessTimeoutCastsNumericStrings()
    {
        config(['doxswap.drivers.process_timeout' => '300']);

        $this->assertSame(300, $this->property($this->app->make(LibreOffice::class), 'timeout'));
    }

    public function testProcessTimeoutNullMeansNoLimit()
    {
        config(['doxswap.drivers.process_timeout' => null]);

        $this->assertNull($this->property($this->app->make(LibreOffice::class), 'timeout'));
    }

    public function testInvalidProcessTimeoutFallsBackTo120()
    {
        config(['doxswap.drivers.process_timeout' => '']);

        $this->assertSame(120, $this->property($this->app->make(LibreOffice::class), 'timeout'));
    }

    public function testImageFormatsUseLibreOfficeForPdfAndImageMagickOtherwise()
    {
        $png = $this->app->make(FormatRegistry::class)->getFormat('png');

        $this->assertInstanceOf(PngFormat::class, $png);
        $this->assertInstanceOf(LibreOffice::class, $png->getDriver('pdf'));
        $this->assertInstanceOf(ImageMagick::class, $png->getDriver('jpg'));
    }
}
