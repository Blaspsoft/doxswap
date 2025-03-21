<?php

namespace Blaspsoft\Doxswap\Formats;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Blaspsoft\Doxswap\Strategies\Pandoc;
use Blaspsoft\Doxswap\Contracts\ConvertibleFormat;
use Blaspsoft\Doxswap\Contracts\ConversionStrategy;

class MarkdownFormat implements ConvertibleFormat
{
    /**
     * Get the name of the format.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'markdown';
    }

    /**
     * Get the MIME types of the format.
     *
     * @return array
     */
    public function getMimeTypes(): array
    {
        return ['text/markdown', 'text/x-markdown', 'application/markdown', 'application/x-markdown', 'text/plain', 'text/html'];
    }

    /**
     * Get the supported conversions for the format.
     *
     * @return array
     */
    public function getSupportedConversions(): array
    {
        return ['pdf', 'docx', 'html', 'epub', 'pptx', 'latex'];
    }

    /**
     * Get the driver for the format.
     *
     * @return \Blaspsoft\Doxswap\Contracts\ConversionStrategy
     */
    public function getDriver(): ConversionStrategy
    {
        return new Pandoc();
    }

    /**
     * Convert the format to a new format.
     *
     * @param string $inputFile
     * @param string $toFormat
     * @return string
     */
    public function convert(string $inputFile, string $toFormat): string
    {
        $complexityScore = $this->getMarkdownComplexityScore($inputFile);

        if ($complexityScore > 3) {
           
        }
        
        return $this->getDriver()->convert($inputFile, $this->getName(), $toFormat);
    }

    /**
     * Get the complexity score of the markdown file.
     *
     * @param string $inputFile
     * @return int
     */
    protected function getMarkdownComplexityScore(string $inputFile): int
    {
        $content = File::get($inputFile);

        $score = 0;

        $score += preg_match_all('/<[^>]+>/', $content);           // HTML
        $score += preg_match_all('/\\\\[a-zA-Z]+/', $content);     // LaTeX
        $score += preg_match_all('/\$\$.*\$\$/s', $content) * 2;   // Math
        $score += preg_match_all('/\|.*\|/', $content);            // Tables
        $score += preg_match_all('/!\[.*\]\(.*\)/', $content);     // Images

        return $score; // 0 = simple, >3 = complex
    }
}