<?php

namespace Blaspsoft\Doxswap\Contracts;

interface ConvertibleFormat
{
    public function getName(): string;

    public function getMimeTypes(): array;

    public function getSupportedConversions(): array;

    public function getDriver(): ConversionStrategy;

    public function convert(string $inputFile, string $toFormat): string;
}