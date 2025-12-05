document.addEventListener("DOMContentLoaded", () => {

    // =====================
    // LOGIN
    // =====================
    const btnLogin = document.getElementById("btnLogin");
    if (btnLogin) {
        btnLogin.addEventListener("click", async () => {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            const res = await app.post("login", { email, password });

            if (res.error) {
                document.getElementById("loginMessage").innerText = res.message;
            } else {
                window.location.href = "dashboard.php";
            }
        });
    }

    // =====================
    // REGISTER
    // =====================
    const btnRegister = document.getElementById("btnRegister");
    if (btnRegister) {
        btnRegister.addEventListener("click", async () => {

            const nameVal = document.getElementById("name").value.trim();
            const emailVal = document.getElementById("email").value.trim();
            const passVal = document.getElementById("password").value.trim();

            const res = await app.post("register", {
                name: nameVal,
                email: emailVal,
                password: passVal
            });

            if (res.error) {
                document.getElementById("registerMessage").innerText = res.message;
            } else {
                window.location.href = "login.php";
            }
        });
    }

});
