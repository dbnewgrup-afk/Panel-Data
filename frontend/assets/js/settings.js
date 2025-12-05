document.addEventListener("DOMContentLoaded", async () => {

    // Load all settings
    const res = await app.get("settings.get");

    if (!res.error) {
        const s = res.data;

        document.getElementById("digiflazz_username").value      = s.digiflazz_username || '';
        document.getElementById("digiflazz_api_key").value       = s.digiflazz_api_key || '';

        document.getElementById("tokoku_client_id").value        = s.tokoku_client_id || '';
        document.getElementById("tokoku_client_secret").value    = s.tokoku_client_secret || '';

        // read-only data, provided by backend
        document.getElementById("tokoku_api_url").value          = s.tokoku_api_url || '';
        document.getElementById("webhook_url").value             = s.webhook_url || '';
    }

    document.getElementById("btnSaveSettings").onclick = async () => {

        const data = {
            digiflazz_username:     document.getElementById("digiflazz_username").value,
            digiflazz_api_key:      document.getElementById("digiflazz_api_key").value,
            tokoku_client_id:       document.getElementById("tokoku_client_id").value,
            tokoku_client_secret:   document.getElementById("tokoku_client_secret").value
        };

        const save = await app.post("settings.update", data);

        alert(save.message);
    };
});
