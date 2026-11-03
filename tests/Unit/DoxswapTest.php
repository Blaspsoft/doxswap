<?php

namespace Blaspsoft\Doxswap\Tests\Unit;

use Blaspsoft\Doxswap\Doxswap;
use Blaspsoft\Doxswap\Tests\TestCase;

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
}
