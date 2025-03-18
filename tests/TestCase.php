<?php

namespace Blaspsoft\Doxswap\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            'Blaspsoft\Doxswap\DoxswapServiceProvider', 
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('doxswap.input_disk', 'input');
        $app['config']->set('doxswap.output_disk', 'output');
        $app['config']->set('doxswap.cleanup_strategy', 'none');
        $app['config']->set('doxswap.drivers.libreoffice.path', '/Applications/LibreOffice.app/Contents/MacOS/soffice');
        $app['config']->set('doxswap.drivers.pandoc.path', '/usr/bin/pandoc');
    }
}