<?php
header('Content-Type: application/json');
session_start();

// Load config & lib
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../lib/Helpers.php';
require_once __DIR__ . '/../../controllers/CallbackController.php';

// Handle callback
$callback = new CallbackController($db);
$callback->handle();
