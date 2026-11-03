# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Doxswap is a Laravel package for document and image format conversions. It wraps LibreOffice (documents) and ImageMagick (images) behind a clean API: `Doxswap::convert('file.docx', 'pdf')`.

## Commands

```bash
# Install dependencies
composer install

# Run all tests
composer test

# Run unit tests only
vendor/bin/phpunit --testsuite=Unit

# Run integration tests only (requires LibreOffice, ImageMagick, Potrace installed)
vendor/bin/phpunit --testsuite=Integration

# Run a single test
vendor/bin/phpunit --filter=TestMethodName

# Test coverage (outputs to ./coverage)
composer test-coverage
```

No linter is configured. Code follows PSR-2.

## Architecture

**Conversion flow:**
`Doxswap` (service) → `FormatRegistry` (validates input, resolves format) → `Format` class (e.g. `DocxFormat`) → `ConversionStrategy` (e.g. `LibreOffice`) → `ConversionResult`

**Key components:**

- `src/Doxswap.php` — Main service class, orchestrates conversion and cleanup
- `src/FormatRegistry.php` — Registers all 21 format handlers, validates files/MIME types, routes conversions
- `src/Strategies/LibreOffice.php` — Wraps headless `soffice` CLI for document conversions
- `src/Strategies/ImageMagick.php` — Wraps PHP Imagick extension for image conversions
- `src/Formats/` — 21 format classes. Document formats extend `AbstractFormat` (LibreOffice only); image formats extend `AbstractImageFormat` (LibreOffice for PDF, ImageMagick otherwise)
- `src/Contracts/` — `ConvertibleFormat` (format interface) and `ConversionStrategy` (strategy interface)
- `src/Filename.php` — Uses `blaspsoft/onym` for output filename generation (original, random, timestamp)
- `src/ConversionResult.php` — DTO for conversion metadata (paths, duration, timestamps)
- `src/ConversionCleanup.php` — Optional post-conversion input file deletion
- `config/config.php` — Input/output disks, cleanup toggle, filename strategy, LibreOffice binary path

**Design patterns:** Strategy pattern for conversion engines, Registry pattern for format lookup, Laravel Facade for public API.

**Notable:** Strategies and formats are built in `DoxswapServiceProvider` from config on every resolve (not singletons), so runtime config changes apply. ZIP-based Office formats (DOCX, XLSX, PPTX) have special MIME type detection fallback.

## System Dependencies

Integration tests and actual conversions require: LibreOffice, ImageMagick (with PHP ext-imagick), and Potrace. The CI workflow installs these on Ubuntu. LibreOffice path is configurable via the `LIBREOFFICE_PATH` env var (`LIBRE_OFFICE_PATH` still works as a fallback), and the process timeout via `DOXSWAP_PROCESS_TIMEOUT`.

## Testing

- Unit tests (`tests/Unit/`) — FormatRegistry, Filename, ConversionCleanup; use Mockery
- Integration tests (`tests/Integration/`) — Real file conversions; require system dependencies
- Test stubs are tracked with Git LFS
- Framework: PHPUnit 11 with Orchestra Testbench
