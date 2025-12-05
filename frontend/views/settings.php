<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<div class="container" style="max-width: 900px;">

    <h3 class="mb-4">Settings</h3>

    <div class="settings-section">

        <!-- DIGIFLAZZ -->
        <div class="settings-title">Digiflazz</div>

        <div class="settings-grid mb-4">

            <div>
                <label class="field-label">Username</label>
                <input type="text" id="digiflazz_username" class="form-control">
            </div>

            <div>
                <label class="field-label">API Key</label>
                <input type="text" id="digiflazz_api_key" class="form-control">
            </div>

        </div>

        <!-- TOKOKU -->
        <div class="settings-title">Tokoku</div>

        <div class="settings-grid mb-4">

            <div>
                <label class="field-label">Client ID</label>
                <input type="text" id="tokoku_client_id" class="form-control">
            </div>

            <div>
                <label class="field-label">Client Secret</label>
                <input type="text" id="tokoku_client_secret" class="form-control">
            </div>

            <div style="grid-column: span 2;">
                <label class="field-label">API URL</label>
                <input type="text" id="tokoku_api_url" class="form-control" readonly>
            </div>

        </div>

        <!-- WEBHOOK -->
        <div class="settings-title">Webhook</div>

        <div>
            <label class="field-label">Webhook URL</label>
            <input type="text" id="webhook_url" class="form-control mb-3" readonly>
        </div>

        <button class="btn btn-primary settings-btn" id="btnSaveSettings">
            Simpan
        </button>

    </div>
</div>

<script src="../assets/js/settings.js"></script>

<?php include("../layout/footer.php"); ?>
