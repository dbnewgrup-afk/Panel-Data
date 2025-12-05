const orderId = new URLSearchParams(window.location.search).get("id");

document.addEventListener("DOMContentLoaded", async () => {
    const res = await app.get("orders.detail", { id: orderId });

    if (res.error) {
        alert(res.message);
        return;
    }

    const o = res.data;

    document.getElementById("od_id").innerText         = o.id;
    document.getElementById("od_product").innerText    = o.product_code;
    document.getElementById("od_target").innerText     = o.target_number;
    document.getElementById("od_cost").innerText       = o.price_cost;
    document.getElementById("od_selling").innerText    = o.price_selling;
    document.getElementById("od_status").innerText     = o.status;
    document.getElementById("od_ref_digi").innerText   = o.digiflazz_ref;
    document.getElementById("od_ref_tokoku").innerText = o.tokoku_ref;
    document.getElementById("od_created").innerText    = o.created_at;

    // Show logs
    let logsHtml = "";
    res.logs.forEach(l => {
        logsHtml += `[${l.created_at}] (${l.direction}) ${l.type}\n${l.payload}\n\n`;
    });

    document.getElementById("orderLogs").innerText = logsHtml;

    // Retry button
    if (o.status === "failed") {
        document.getElementById("btnRetry").style.display = "block";
    }

    document.getElementById("btnRetry").onclick = async () => {
        if (!confirm("Retry order?")) return;
        const retry = await app.get("orders.retry", { id: orderId });
        alert(retry.message);
        location.reload();
    };
});
