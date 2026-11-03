# Upgrade Guide

## Upgrading to 2.0 from 1.x

Most apps that only call `Doxswap::convert()` through the facade need no code changes. The changes below affect apps that catch specific exceptions, build Doxswap classes themselves, or add custom formats.

### LibreOffice failures throw `ConversionFailedException`

A failed `soffice` process used to throw Symfony's `ProcessFailedException`. It now throws `Blaspsoft\Doxswap\Exceptions\ConversionFailedException`, with the original `ProcessFailedException` available from `getPrevious()`.

```php
// Before
catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) { ... }

// After
catch (\Blaspsoft\Doxswap\Exceptions\ConversionFailedException $e) { ... }
```

A missing Imagick extension now throws `ImagickExtensionNotFoundException`, and an unknown input format throws `FormatNotFoundException`, instead of a generic `Exception`.

### Classes are resolved from the container

`Doxswap`, `FormatRegistry`, `ConversionCleanup`, `Filename`, `LibreOffice`, `ImageMagick` and `ConversionResult` now take their settings through their constructors instead of reading config. Resolve them from the container instead of using `new`:

```php
// Before
$doxswap = new Doxswap();

// After
$doxswap = app('doxswap'); // or use the Doxswap facade
```

`Filename::rename()` is now an instance method: use `app(Filename::class)->rename($path)`.

### Custom formats

`ConvertibleFormat::getDriver()` now takes the target format: `getDriver(?string $toFormat = null)`. Custom formats should extend `Blaspsoft\Doxswap\Formats\AbstractFormat` (LibreOffice) or `AbstractImageFormat` (LibreOffice for PDF, ImageMagick otherwise), and be registered on the `FormatRegistry`.

### Configuration

- The LibreOffice path env var is now `LIBREOFFICE_PATH`. `LIBRE_OFFICE_PATH` still works as a fallback.
- New `drivers.process_timeout` option (env `DOXSWAP_PROCESS_TIMEOUT`, default 120 seconds, `null` for no limit). Republish the config or add the key if you have a published config file.
