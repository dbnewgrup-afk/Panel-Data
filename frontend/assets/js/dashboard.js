document.addEventListener("DOMContentLoaded", async () => {

    // Load stats
    const stats = await app.get("dashboard.stats");
    if (!stats.error) {
        document.getElementById("statTotal").innerText   = stats.data.total;
        document.getElementById("statSuccess").innerText = stats.data.success;
        document.getElementById("statPending").innerText = stats.data.pending;
        document.getElementById("statFailed").innerText  = stats.data.failed;
    }

    // Load latest orders (limit = 5)
    const orders = await app.get("orders.list", { page: 1 });
    const tbody = document.getElementById("latestOrders");

    tbody.innerHTML = "";

    orders.data.slice(0, 5).forEach(o => {
        tbody.innerHTML += `
            <tr>
                <td>${o.id}</td>
                <td>${o.product_code}</td>
                <td>${o.target_number}</td>
                <td>${o.status}</td>
                <td>${o.created_at}</td>
            </tr>
        `;
    });

});
