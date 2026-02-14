<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Vercel Bridge for Laravel
 */

// 1. Buat direktori storage yang dibutuhkan di /tmp
$storageFolders = [
    '/tmp/framework/cache/data',
    '/tmp/framework/views',
    '/tmp/framework/sessions',
    '/tmp/logs',
];

foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}

// 2. Load aplikasi utama
require __DIR__ . '/../public/index.php';
