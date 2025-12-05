<?php
session_start();

// Jika belum login → ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.php");
    exit;
}

// Jika sudah login → ke dashboard
header("Location: views/dashboard.php");
exit;
