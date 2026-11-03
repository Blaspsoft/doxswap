<?php

namespace Blaspsoft\Doxswap;

use Illuminate\Support\ServiceProvider;
use Blaspsoft\Doxswap\Strategies\LibreOffice;
use Blaspsoft\Doxswap\Strategies\ImageMagick;
use Blaspsoft\Doxswap\Formats\BmpFormat;
use Blaspsoft\Doxswap\Formats\CsvFormat;
use Blaspsoft\Doxswap\Formats\DocFormat;
use Blaspsoft\Doxswap\Formats\DocxFormat;
use Blaspsoft\Doxswap\Formats\GifFormat;
use Blaspsoft\Doxswap\Formats\HtmlFormat;
use Blaspsoft\Doxswap\Formats\JpgFormat;
use Blaspsoft\Doxswap\Formats\OdpFormat;
use Blaspsoft\Doxswap\Formats\OdsFormat;
use Blaspsoft\Doxswap\Formats\OdtFormat;
use Blaspsoft\Doxswap\Formats\PngFormat;
use Blaspsoft\Doxswap\Formats\PptFormat;
use Blaspsoft\Doxswap\Formats\PptxFormat;
use Blaspsoft\Doxswap\Formats\RtfFormat;
use Blaspsoft\Doxswap\Formats\SvgFormat;
use Blaspsoft\Doxswap\Formats\TiffFormat;
use Blaspsoft\Doxswap\Formats\TxtFormat;
use Blaspsoft\Doxswap\Formats\WebpFormat;
use Blaspsoft\Doxswap\Formats\XlsFormat;
use Blaspsoft\Doxswap\Formats\XlsxFormat;
use Blaspsoft\Doxswap\Formats\XmlFormat;

class DoxswapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('doxswap.php'),
            ], 'doxswap-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'doxswap');

        $this->app->bind(Filename::class, function ($app) {
            return new Filename(
                config('doxswap.filename.strategy'),
                config('doxswap.filename.options'),
                config('doxswap.output_disk')
            );
        });

        $this->app->bind(LibreOffice::class, function ($app) {
            return new LibreOffice(
                config('doxswap.drivers.libreoffice_path'),
                config('doxswap.input_disk'),
                config('doxswap.output_disk'),
                $app->make(Filename::class),
                $this->processTimeout()
            );
        });

        $this->app->bind(ImageMagick::class, function ($app) {
            return new ImageMagick(
                config('doxswap.input_disk'),
                config('doxswap.output_disk'),
                $app->make(Filename::class)
            );
        });

        $this->app->bind(FormatRegistry::class, function ($app) {
            $libreOffice = $app->make(LibreOffice::class);
            $imageMagick = $app->make(ImageMagick::class);

            return new FormatRegistry(
                config('doxswap.input_disk'),
                [
                    new DocFormat($libreOffice),
                    new DocxFormat($libreOffice),
                    new OdtFormat($libreOffice),
                    new RtfFormat($libreOffice),
                    new TxtFormat($libreOffice),
                    new HtmlFormat($libreOffice),
                    new XmlFormat($libreOffice),
                    new XlsFormat($libreOffice),
                    new XlsxFormat($libreOffice),
                    new OdsFormat($libreOffice),
                    new PptxFormat($libreOffice),
                    new PptFormat($libreOffice),
                    new OdpFormat($libreOffice),
                    new CsvFormat($libreOffice),
                    new SvgFormat($libreOffice, $imageMagick),
                    new JpgFormat($libreOffice, $imageMagick),
                    new PngFormat($libreOffice, $imageMagick),
                    new BmpFormat($libreOffice, $imageMagick),
                    new TiffFormat($libreOffice, $imageMagick),
                    new GifFormat($libreOffice, $imageMagick),
                    new WebpFormat($libreOffice, $imageMagick),
                ]
            );
        });

        $this->app->bind(ConversionCleanup::class, function ($app) {
            return new ConversionCleanup(
                config('doxswap.input_disk'),
                config('doxswap.perform_cleanup')
            );
        });

        $this->app->bind('doxswap', function ($app) {
            return new Doxswap(
                $app->make(FormatRegistry::class),
                $app->make(ConversionCleanup::class)
            );
        });
    }

    /**
     * Get the LibreOffice process timeout from config.
     *
     * @return int|null
     */
    protected function processTimeout(): ?int
    {
        $timeout = config('doxswap.drivers.process_timeout', 120);

        if ($timeout === null) {
            return null;
        }

        return is_numeric($timeout) ? (int) $timeout : 120;
    }
}
