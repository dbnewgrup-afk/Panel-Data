const loadOrders = async (page = 1) => {
    const search     = document.getElementById("search").value;
    const status     = document.getElementById("status").value;
    const start_date = document.getElementById("start_date").value;
    const end_date   = document.getElementById("end_date").value;

    const res = await app.get("orders.list", {
        page, search, status, start_date, end_date
    });

    const tbody = document.getElementById("ordersTable");
    tbody.innerHTML = "";

    res.data.forEach(o => {
        tbody.innerHTML += `
            <tr>
                <td>${o.id}</td>
                <td>${o.product_code}</td>
                <td>${o.target_number}</td>
                <td>${o.status}</td>
                <td>${o.created_at}</td>
                <td>
                    <a href="order_detail.php?id=${o.id}" class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
        `;
    });

    // Basic pagination
    document.getElementById("pagination").innerHTML = `
        <button class="btn btn-secondary me-2" onclick="loadOrders(${page - 1})" ${page <= 1 ? "disabled" : ""}>Prev</button>
        <button class="btn btn-secondary" onclick="loadOrders(${page + 1})">Next</button>
    `;
};

document.getElementById("btnFilter").onclick = () => loadOrders(1);

document.addEventListener("DOMContentLoaded", () => loadOrders(1));
