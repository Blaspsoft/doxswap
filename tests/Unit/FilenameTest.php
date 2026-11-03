<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use ReflectionClass;
use Blaspsoft\Doxswap\Filename;
use Blaspsoft\Doxswap\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class FilenameTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
    }

    public function testGenerateFileNameOriginalStrategy()
    {
        $filePath = 'path/to/original/file.txt';

        $filename = new Filename('original', [], 'local');

        $reflection = new ReflectionClass(Filename::class);
        $method = $reflection->getMethod('generateFileName');
        $method->setAccessible(true);

        $generatedFileName = $method->invoke($filename, $filePath);

        $this->assertEquals(basename($filePath), $generatedFileName);
    }

    public function testGenerateFileNameRandomStrategy()
    {
        $filePath = 'path/to/original/file.txt';

        $filename = new Filename('random', ['length' => 24], 'local');

        $reflection = new ReflectionClass(Filename::class);
        $method = $reflection->getMethod('generateFileName');
        $method->setAccessible(true);

        $generatedFileName = $method->invoke($filename, $filePath);

        $this->assertNotEquals(basename($filePath), $generatedFileName);
        $this->assertStringEndsWith('.txt', $generatedFileName);
    }

    public function testGenerateFileNameTimestampStrategy()
    {
        $filePath = 'path/to/original/file.txt';

        $filename = new Filename('timestamp', ['format' => 'YmdHis'], 'local');

        $reflection = new ReflectionClass(Filename::class);
        $method = $reflection->getMethod('generateFileName');
        $method->setAccessible(true);

        $generatedFileName = $method->invoke($filename, $filePath);

        $this->assertNotEquals(basename($filePath), $generatedFileName);
        $this->assertStringEndsWith('.txt', $generatedFileName);
    }
}
