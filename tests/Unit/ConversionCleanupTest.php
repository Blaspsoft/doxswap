<?php

namespace Tests;

use Blaspsoft\Doxswap\ConversionCleanup;
use Illuminate\Support\Facades\Storage;
use Orchestra\Testbench\TestCase;

class ConversionCleanupTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock the Storage facade
        Storage::shouldReceive('disk')
            ->andReturnSelf();
    }

    protected function getEnvironmentSetUp($app)
    {
        // Set up configuration values for testing
        $app['config']->set('doxswap.input_disk', 'local');
        $app['config']->set('doxswap.output_disk', 'local');
    }

    public function testPerformCleanupTrue()
    {
        $this->app['config']->set('doxswap.perform_cleanup', true);

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->once()
            ->with('inputFile.txt');

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }

    public function testPerformCleanupFalse()
    {
        $this->app['config']->set('doxswap.perform_cleanup', false);

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->never();

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }
}