<?php
require 'vendor/autoload.php';

use Dompdf\Options;
use Dompdf\Dompdf;

// Define directories
$fontDir = __DIR__ . '/storage/fonts';
$fontCache = __DIR__ . '/storage/fonts';
$logOutputFile = __DIR__ . '/storage/logs/dompdf.log';
$tempDir = __DIR__ . '/storage/temp';

// Ensure directories exist
if (!is_dir($fontDir)) {
    mkdir($fontDir, 0777, true);
}
if (!is_dir($fontCache)) {
    mkdir($fontCache, 0777, true);
}
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0777, true);
}
if (!is_dir(dirname($logOutputFile))) {
    mkdir(dirname($logOutputFile), 0777, true);
}

// Set options
$options = new Options();
$options->set('fontDir', $fontDir);
$options->set('fontCache', $fontCache);
$options->set('logOutputFile', $logOutputFile);
$options->set('tempDir', $tempDir);

// Initialize Dompdf
$dompdf = new Dompdf($options);

// Register the font
$dompdf->getFontMetrics()->getFont('Open Sans', 'normal', true);

echo "Font loaded successfully.";
