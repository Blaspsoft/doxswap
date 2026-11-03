<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Blaspsoft\Doxswap\ConversionCleanup;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ConversionCleanupTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::shouldReceive('disk')
            ->andReturnSelf();
    }

    public function testPerformCleanupTrue()
    {
        $conversionCleanup = new ConversionCleanup('local', true);

        Storage::shouldReceive('delete')
            ->once()
            ->with('inputFile.txt');

        $conversionCleanup->cleanup('inputFile.txt');
    }

    public function testPerformCleanupFalse()
    {
        $conversionCleanup = new ConversionCleanup('local', false);

        Storage::shouldReceive('delete')
            ->never();

        $conversionCleanup->cleanup('inputFile.txt');
    }
}
