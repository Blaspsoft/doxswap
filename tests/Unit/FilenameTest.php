<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Mockery;
use ReflectionClass;
use Blaspsoft\Doxswap\Filename;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Storage;

class FilenameTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set up any necessary configuration
        config()->set('doxswap.filename.strategy', 'original');
        config()->set('doxswap.filename.options', []);
        config()->set('doxswap.output_disk', 'local');

        // Mock the storage disk
        Storage::fake('local');
    }

    public function testGenerateFileNameOriginalStrategy()
    {
        $filePath = 'path/to/original/file.txt';

        config()->set('doxswap.filename.strategy', 'original');

        $reflection = new ReflectionClass(Filename::class);
        $method = $reflection->getMethod('generateFileName');
        $method->setAccessible(true);

        $filenameInstance = new Filename();
        $generatedFileName = $method->invoke($filenameInstance, $filePath);

        $this->assertEquals(basename($filePath), $generatedFileName);
    }

   public function testGenerateFileNameMethod()
    {
        $filePath = 'path/to/original/file.txt';

        // Use reflection to access the protected method
        $reflection = new ReflectionClass(Filename::class);
        $method = $reflection->getMethod('generateFileName');
        $method->setAccessible(true);

        $filenameInstance = new Filename();
        $generatedFileName = $method->invoke($filenameInstance, $filePath);

        // Assert that the generated file name is as expected
        $this->assertEquals(basename($filePath), $generatedFileName);
    }
}
