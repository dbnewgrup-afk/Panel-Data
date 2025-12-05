<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container" style="max-width: 760px;">

    <h3 class="mb-4">Profile</h3>

    <!-- ============================
         INFORMASI AKUN
    ============================ -->
    <div class="profile-section mb-4">
        <div class="section-title">Informasi Akun</div>
        <div class="section-body">

            <div class="info-row">
                <span class="label">Nama</span>
                <span class="value" id="info_name">-</span>
            </div>

            <div class="info-row">
                <span class="label">Email</span>
                <span class="value" id="info_email">-</span>
            </div>

            <div class="info-row">
                <span class="label">Password</span>
                <span class="value d-flex align-items-center gap-2">
                    <span id="info_plain_pw" class="mono masked">********</span>
                    <i id="togglePlainPW" class="bi bi-eye cursor-pointer"></i>
                </span>
            </div>

            <div class="info-row">
                <span class="label">Member Sejak</span>
                <span class="value" id="info_created">-</span>
            </div>

            <div class="info-row">
                <span class="label">Terakhir Login</span>
                <span class="value" id="info_lastlogin">-</span>
            </div>

        </div>
    </div>


    <!-- ============================
         UPDATE NAMA
    ============================ -->
    <div class="profile-section mb-4">
        <div class="section-title">Ubah Nama</div>
        <div class="section-body">

            <label class="field-label">Nama Baru</label>
            <input type="text" id="profile_name" class="form-control mb-3">

            <button class="btn btn-primary" id="btnSaveName">Simpan Perubahan</button>
        </div>
    </div>


    <!-- ============================
         UPDATE PASSWORD
    ============================ -->
    <div class="profile-section mb-4">
        <div class="section-title">Ganti Password</div>
        <div class="section-body">

            <label class="field-label">Password Baru</label>
            <input type="password" id="profile_pw" class="form-control mb-3">

            <label class="field-label">Konfirmasi Password</label>
            <input type="password" id="profile_pw2" class="form-control mb-3">

            <button class="btn btn-warning" id="btnSavePassword">Update Password</button>
        </div>
    </div>

</div>

<script src="../assets/js/profile.js"></script>

<?php include("../layout/footer.php"); ?>
