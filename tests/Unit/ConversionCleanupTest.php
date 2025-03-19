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
        $app['config']->set('doxswap.cleanup_strategy', 'both');
    }

    public function testCleanupInput()
    {
        $this->app['config']->set('doxswap.cleanup_strategy', 'input');

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->once()
            ->with('inputFile.txt');

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }

    public function testCleanupOutput()
    {
        $this->app['config']->set('doxswap.cleanup_strategy', 'output');

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->once()
            ->with('outputFile.txt');

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }

    public function testCleanupBoth()
    {
        $this->app['config']->set('doxswap.cleanup_strategy', 'both');

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->once()
            ->with('inputFile.txt');

        Storage::shouldReceive('delete')
            ->once()
            ->with('outputFile.txt');

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }

    public function testCleanupNone()
    {
        $this->app['config']->set('doxswap.cleanup_strategy', 'none');

        $conversionCleanup = new ConversionCleanup();

        Storage::shouldReceive('delete')
            ->never();

        $conversionCleanup->cleanup('inputFile.txt', 'outputFile.txt');
    }
}