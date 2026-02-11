<?php

/**
 * Vercel Bridge for Laravel
 * File ini memastikan folder storage tersedia di /tmp sebelum menjalankan aplikasi.
 */

// List folder framework yang wajib ada agar Laravel tidak error
$storageFolders = [
    '/tmp/framework/cache/data',
    '/tmp/framework/views',
    '/tmp/framework/sessions',
    '/tmp/logs',
];

// Buat folder secara otomatis jika belum ada di direktori /tmp
foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}

// Teruskan request ke file index utama Laravel
require __DIR__ . '/../public/index.php';
