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
    <title>Register - Panel Data</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body class="auth-body">

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- badge -->
        <div class="auth-badge">
            <span class="icon">📝</span>
            <span>Create Account</span>
        </div>

        <!-- Title -->
        <h1 class="auth-title">Register Account</h1>
        <p class="auth-subtitle">Daftar untuk mulai menggunakan Panel Data.</p>

        <!-- Form -->
        <form class="auth-form">

            <div class="mb-3">
                <label class="auth-label">Nama Lengkap</label>
                <input type="text" id="name" class="form-control" placeholder="Nama Anda">
            </div>

            <div class="mb-3">
                <label class="auth-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email aktif">
            </div>

            <div class="mb-3">
                <label class="auth-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Min. 6 karakter">
                    <button class="btn-toggle-pass btn" type="button" id="togglePass">Show</button>
                </div>
            </div>

            <div class="mb-3">
                <label class="auth-label">Confirm Password</label>
                <input type="password" id="password2" class="form-control" placeholder="Ulangi password">
            </div>

            <button class="btn-auth-primary" type="button" id="btnRegister">Register</button>

        </form>

        <!-- Footer link -->
        <div class="auth-footer">
            Sudah punya akun? <a href="login.php">Login</a>
        </div>

        <!-- Message -->
        <div id="registerMessage" class="text-danger text-center mt-3"></div>

    </div>
</div>

<script src="/PANEL-DATA/frontend/assets/js/app.js"></script>
<script src="/PANEL-DATA/frontend/assets/js/auth.js"></script>

<script>
// show / hide both password fields
document.getElementById("togglePass").onclick = () => {
    let p1 = document.getElementById("password");
    let p2 = document.getElementById("password2");

    const show = p1.type === "password";

    p1.type = show ? "text" : "password";
    p2.type = show ? "text" : "password";

    togglePass.textContent = show ? "Hide" : "Show";
};

// register action with validation
document.getElementById("btnRegister").onclick = async () => {
    const nameVal = document.getElementById("name").value.trim();
    const emailVal = document.getElementById("email").value.trim();
    const passVal = document.getElementById("password").value.trim();
    const passVal2 = document.getElementById("password2").value.trim();

    // simple validation
    if (!nameVal || !emailVal || !passVal || !passVal2) {
        return showMessage("Semua field harus diisi");
    }

    if (passVal.length < 6) {
        return showMessage("Password minimal 6 karakter");
    }

    if (passVal !== passVal2) {
        return showMessage("Password tidak sama");
    }

    // API request
    const res = await app.post("register", {
        name: nameVal,
        email: emailVal,
        password: passVal
    });

    if (res.error) {
        showMessage(res.message);
    } else {
        window.location.href = "login.php";
    }
};

function showMessage(text) {
    document.getElementById("registerMessage").innerText = text;
}
</script>

</body>
</html>
