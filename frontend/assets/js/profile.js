document.addEventListener("DOMContentLoaded", async () => {

    // ===============================
    // LOAD USER DATA
    // ===============================
    const u = await app.authMe();
    if (!u) return;

    // Set informasi akun ke UI
    document.getElementById("info_name").innerText = u.name;
    document.getElementById("info_email").innerText = u.email;
    document.getElementById("info_plain_pw").innerText = "********"; // default masked
    document.getElementById("info_created").innerText = u.created_at ?? "-";
    document.getElementById("info_lastlogin").innerText = u.updated_at ?? "-";

    // Set input nama default
    document.getElementById("profile_name").value = u.name;

    // ===============================
    // SHOW / HIDE plain_password
    // ===============================
    const pwText = document.getElementById("info_plain_pw");
    const toggleBtn = document.getElementById("togglePlainPW");
    let visible = false;

    toggleBtn.onclick = () => {
        visible = !visible;

        if (visible) {
            pwText.innerText = u.plain_password ?? "";
            toggleBtn.classList.remove("bi-eye");
            toggleBtn.classList.add("bi-eye-slash");
        } else {
            pwText.innerText = "********";
            toggleBtn.classList.remove("bi-eye-slash");
            toggleBtn.classList.add("bi-eye");
        }
    };


    // ===============================
    // UPDATE NAMA
    // ===============================
    document.getElementById("btnSaveName").onclick = async () => {

        const name = document.getElementById("profile_name").value.trim();
        const res  = await app.post("profile.update", { name });

        alert(res.message);

        if (!res.error) {
            document.getElementById("info_name").innerText = name;
        }
    };


    // ===============================
    // UPDATE PASSWORD
    // ===============================
    document.getElementById("btnSavePassword").onclick = async () => {

        const pw  = document.getElementById("profile_pw").value.trim();
        const pw2 = document.getElementById("profile_pw2").value.trim();

        const res = await app.post("password.update", {
            password: pw,
            password_confirm: pw2
        });

        alert(res.message);
    };

});
