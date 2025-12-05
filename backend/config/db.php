<?php
/**
 * Database Connection
 * Digunakan seluruh backend via variabel $db
 */

$DB_HOST = 'localhost';
$DB_NAME = 'panel_data';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $db = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",
        $DB_USER,
        $DB_PASS
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die(json_encode([
        'error' => true,
        'message' => 'Database connection failed',
        'detail' => $e->getMessage()
    ]));
}
