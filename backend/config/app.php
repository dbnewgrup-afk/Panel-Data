<?php
/**
 * App Configuration
 * Pengaturan global aplikasi
 */

$app = [
    // URL backend/public (wajib untuk callback Digiflazz & API)
    'base_url' => '/Panel-Data/backend/public',

    // Timezone default
    'timezone' => 'Asia/Jakarta',

    // Mode aplikasi
    'env' => 'production', // atau 'development'
];
$app = [
    'base_url' => '/Panel-Data/backend/public',
    'timezone' => 'Asia/Jakarta',
    'env'      => 'production'
];
// Set timezone global
date_default_timezone_set($app['timezone']);
