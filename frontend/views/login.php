<?php 
session_start(); 
if (isset($_SESSION['user_id'])) { 
    header("Location: dashboard.php"); 
    exit; 
} 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Panel Data</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body class="auth-body">

<!-- efek blob -->
<div class="auth-blob blob-1"></div>
<div class="auth-blob blob-2"></div>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- badge -->
        <div class="auth-badge">
            <span class="icon">🔐</span>
            <span>Panel Access</span>
        </div>

        <!-- Title -->
        <h1 class="auth-title">Login Panel</h1>
        <p class="auth-subtitle">Silakan masuk untuk melanjutkan ke dashboard.</p>

        <!-- Form -->
        <form class="auth-form">

            <div class="mb-3">
                <label class="auth-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="nama@domain.com">
            </div>

            <div class="mb-3">
                <label class="auth-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Masukkan password">
                    <button class="btn-toggle-pass btn" type="button" id="togglePass">Show</button>
                </div>
            </div>

            <button class="btn-auth-primary mt-2" type="button" id="btnLogin">Login</button>

        </form>

        <!-- Footer link -->
        <div class="auth-footer">
            <a href="register.php">Create Account</a>
        </div>

        <!-- Message -->
        <div id="loginMessage" class="text-danger text-center mt-3"></div>

    </div>
</div>

<script src="/PANEL-DATA/frontend/assets/js/app.js"></script>
<script src="/PANEL-DATA/frontend/assets/js/auth.js"></script>

<script>
// show / hide password
document.getElementById("togglePass").onclick = () => {
    let p = document.getElementById("password");
    if (p.type === "password") {
        p.type = "text";
        togglePass.textContent = "Hide";
    } else {
        p.type = "password";
        togglePass.textContent = "Show";
    }
};
</script>

</body>
</html>
