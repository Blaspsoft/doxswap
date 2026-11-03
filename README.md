<p align="center">
    <img src="./.github/assets/icon.png" alt="Onym Icon" width="150" height="150"/>
    <p align="center">
        <a href="https://github.com/Blaspsoft/doxswap/actions/workflows/main.yml"><img alt="GitHub Workflow Status (main)" src="https://github.com/Blaspsoft/doxswap/actions/workflows/main.yml/badge.svg"></a>
        <a href="https://packagist.org/packages/blaspsoft/doxswap"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/blaspsoft/doxswap"></a>
        <a href="https://packagist.org/packages/blaspsoft/doxswap"><img alt="Latest Version" src="https://img.shields.io/packagist/v/blaspsoft/doxswap"></a>
        <a href="https://packagist.org/packages/blaspsoft/doxswap"><img alt="License" src="https://img.shields.io/packagist/l/blaspsoft/doxswap"></a>
    </p>
</p>

# Doxswap

A Laravel package for seamless document and image format conversions. Transform between various formats like DOCX -> PDF, HTML -> PDF, PNG -> WEBP, and more popular formats using a simple, elegant API. Powered by LibreOffice for documents and ImageMagick for image processing.

## 🚀 Features

- 📄 **Multiple Format Support** – Convert between documents (DOCX, XLSX, ODT) and images (PNG, JPG, WEBP) with ease
- 🚀 **Simple API** – Easy-to-use interface for all conversion operations
- 💾 **Laravel Storage Integration** – Works seamlessly with Laravel's filesystem drivers
- ⚡ **Efficient Processing** – Optimized conversion using LibreOffice and ImageMagick engines
- 🔍 **Conversion Tracking** – Detailed results including duration and file paths
- 🔒 **Secure File Handling** – Safe and secure file processing with proper cleanup
- ⚙️ **Configurable Settings** – Customize paths, storage disks, and conversion options
- 🛡️ **Error Handling** – Robust exception handling for unsupported formats and conversions

## Installation

You can install the package via composer:

```bash
composer require blaspsoft/doxswap
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="doxswap-config"
```

### Overview

The `config/doxswap.php` file includes:

#### 💾 Storage & Cleanup

- `input_disk`: Where to read files from (default: 'public')
- `output_disk`: Where to save converted files (default: 'public')
- `perform_cleanup`: Delete input files after conversion (default: false)

#### 📝 File Naming

Configure how output files are named using different strategies:

```php
'filename' => [
    // Strategy: 'original', 'random', or 'timestamp'
    'strategy' => 'original',

    // Naming options
    'options' => [
        'length' => 24,          // Length for random names
        'prefix' => '',          // Add prefix to filename
        'suffix' => '',          // Add suffix to filename
        'separator' => '_',      // Separator for components
        'format' => 'YmdHis',    // Format for timestamp strategy
    ],
]
```

#### 🛠️ Conversion Drivers

Configure paths for conversion tools:

```php
'drivers' => [
    'libreoffice_path' => env('LIBREOFFICE_PATH', env('LIBRE_OFFICE_PATH', '/usr/bin/soffice')),
    'process_timeout' => env('DOXSWAP_PROCESS_TIMEOUT', 120), // seconds, or null for no limit
]
```

Default LibreOffice paths by OS:

- 🐧 Linux: `/usr/bin/soffice`
- 🍎 macOS: `/Applications/LibreOffice.app/Contents/MacOS/soffice`
- 🪟 Windows: `C:\Program Files\LibreOffice\program\soffice.exe`

#### 📄 File Types

Supports various document formats including:

- Documents: DOC, DOCX, ODT, RTF, TXT
- Spreadsheets: XLS, XLSX, ODS, CSV
- Presentations: PPT, PPTX, ODP
- Images: JPG, PNG, SVG, BMP, TIFF, WEBP, GIF
- Web: HTML, XML
- Other: PDF

### Usage

```php
$result = Doxswap::convert('sample.docx', 'pdf');

/**
 * Returns a ConversionResult object with the following properties:
 *
 * @property string $inputFilename   The original input filename
 * @property string $inputFilePath   The full path to the input file
 * @property string $outputFilename  The converted output filename
 * @property string $outputFilePath  The full path to the converted output file
 * @property string $toFormat       The format the file was converted to (e.g. 'pdf')
 * @property string $duration       The time taken for conversion (e.g. "2.21 sec")
 * @property float  $startTime      Unix timestamp of when conversion started
 * @property float  $endTime        Unix timestamp of when conversion completed
 * @property string $inputDisk      The Laravel storage disk used for input
 * @property string $outputDisk     The Laravel storage disk used for output
 */

```

## Requirements

### LibreOffice & ImageMagick

This package requires LibreOffice, ImageMagick, and Potrace to be installed on your system. Here's how to install them:

#### Ubuntu/Debian

```bash
sudo apt update
sudo apt install libreoffice imagemagick potrace
```

#### macOS

```bash
brew install libreoffice imagemagick potrace
```

#### Windows

```bash
choco install libreoffice imagemagick potrace
```

#### Docker

If you're using Docker, you can add the required dependencies to your container:

```dockerfile
# Ubuntu/Debian based
RUN apt-get update && apt-get install -y libreoffice imagemagick potrace

# Alpine based
RUN apk add --no-cache libreoffice imagemagick potrace
```

### PHP Requirements

- PHP >= 8.1
- ext-fileinfo
- ext-imagick
- Laravel >= 9.0

## 🔁 Supported Conversions by Category

### 📝 Documents

| From | Supported Conversions                          |
| ---- | ---------------------------------------------- |
| DOCX | PDF ✅✅, ODT, RTF, TXT, HTML, XML, EPUB       |
| DOC  | PDF ✅✅, DOCX, ODT, RTF, TXT, HTML, XML, EPUB |
| ODT  | PDF, DOCX, RTF, TXT, HTML, XML                 |
| RTF  | PDF, DOCX, ODT, TXT, HTML, XML                 |
| TXT  | PDF, DOCX, ODT, HTML, XML                      |
| HTML | PDF, ODT, TXT                                  |
| XML  | PDF, DOCX, ODT, TXT, HTML                      |

### 📊 Spreadsheets

| From | Supported Conversions |
| ---- | --------------------- |
| XLSX | PDF ✅✅, ODS, CSV    |
| XLS  | PDF, XLSX, ODS, CSV   |
| ODS  | PDF, XLSX, CSV        |
| CSV  | PDF, XLSX, ODS        |

### 🎯 Presentations

| From | Supported Conversions |
| ---- | --------------------- |
| PPTX | PDF ✅✅, ODP         |
| PPT  | PDF, PPTX, ODP        |
| ODP  | PDF, PPTX             |

### 🖼️ Images

| From | Supported Conversions                  |
| ---- | -------------------------------------- |
| PNG  | PDF ✅, JPG, SVG, TIFF, WEBP, GIF, BMP |
| JPG  | PDF ✅, PNG, SVG, TIFF, WEBP, GIF, BMP |
| SVG  | PDF, PNG, JPG, TIFF, WEBP, GIF, BMP    |
| BMP  | PDF, PNG, JPG, SVG, TIFF, WEBP, GIF    |
| TIFF | PDF, PNG, JPG, SVG, WEBP, GIF, BMP     |
| WEBP | PDF, PNG, JPG, SVG, TIFF, GIF, BMP     |
| GIF  | PDF, PNG, JPG, SVG, TIFF, WEBP, BMP    |

### Legend 🔍

- ✅✅ = Common high-priority conversion
- ✅ = Popular supported format
- (unlisted) = Conversion not supported

> **Note**: Document conversions are performed using LibreOffice in headless mode, while image format conversions utilize ImageMagick 🚀

## 🤝 Sponsors

If you find this package helpful, please consider sponsoring the development:

> 🚀 [Become a GitHub Sponsor](https://github.com/sponsors/Blaspsoft)

## License

Blasp is open-sourced software licensed under the [MIT license](LICENSE).
