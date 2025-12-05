const app = {
    // BASE API (TANPA http://localhost)
    api: (function () {
        // ambil path sampai sebelum "/frontend/"
        const path = window.location.pathname;
        const base = path.split('/frontend/')[0];   // contoh: "/panel-data"
        return `${base}/backend/public/api.php`;    // "/panel-data/backend/public/api.php"
    })(),

    /**
     * Fetch GET
     */
    get: async function(action, params = {}) {
        const url = new URL(this.api, window.location.origin);
        url.searchParams.append("action", action);

        Object.keys(params).forEach(k => url.searchParams.append(k, params[k]));

        const res = await fetch(url, {
            method: "GET",
            credentials: "include"
        });

        return res.json();
    },

    /**
     * Fetch POST
     */
    post: async function(action, data = {}) {
        const form = new FormData();
        for (let k in data) form.append(k, data[k]);

        const url = new URL(this.api, window.location.origin);
        url.searchParams.append("action", action);

        const res = await fetch(url.toString(), {
            method: "POST",
            body: form,
            credentials: "include"
        });

        return res.json();
    },

    /**
     * Ambil info user login
     */
    authMe: async function() {
        const res = await this.get("me");
        if (res.error) return null;
        return res.data;
    }
};
