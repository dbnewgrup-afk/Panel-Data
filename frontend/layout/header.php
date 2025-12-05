<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel Data</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/layout.css">

    <!-- App JS -->
    <script src="../assets/js/app.js"></script>
</head>

<body>

    <!-- PREMIUM HEADER -->
    <nav class="header-bar">

        <!-- LEFT GROUP -->
        <div class="d-flex align-items-center gap-3">

            <!-- Sidebar Toggle -->
            <button id="sidebarToggle" class="sidebar-toggle-btn">
                ☰
            </button>

            <!-- Logo -->
            <a href="../views/dashboard.php" class="header-logo">
                Panel Data
            </a>

        </div>

        <!-- RIGHT GROUP -->
        <div class="d-flex align-items-center gap-3">

            <!-- Username → profile -->
            <button class="btn-header-link" id="btnProfile">
                <span id="header-username">User</span>
            </button>

            <!-- Logout -->
            <button class="btn-logout" id="btnLogout">Logout</button>

        </div>

    </nav>

    <script>
        /* Load user */
        document.addEventListener("DOMContentLoaded", async () => {
            const user = await app.authMe();
            if (user) {
                document.getElementById("header-username").innerText = user.name;
            }
        });

        /* Go to profile */
        document.getElementById("btnProfile").onclick = () => {
            window.location.href = "../views/profile.php";
        };

        /* Logout */
        document.getElementById("btnLogout").onclick = async () => {
            const res = await app.post("logout");
            if (!res.error) {
                window.location.href = "../views/login.php";
            }
        };

        /* SIDEBAR COLLAPSE — versi FIX agar tidak hilang, hanya mengecil */
        document.getElementById("sidebarToggle").onclick = () => {
            document.body.classList.toggle("sidebar-collapsed");
        };
    </script>

    <!-- WRAPPER START -->
    <div class="d-flex" id="wrapper">
