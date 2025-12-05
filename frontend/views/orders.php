<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<div class="container" style="max-width: 1150px;">

    <h3 class="mb-4">Orders</h3>

    <!-- ============================
         FILTER BAR
    ============================ -->
    <div class="filter-bar mb-4">

        <div>
            <label>Cari</label>
            <input type="text" id="search" class="form-control" placeholder="Search">
        </div>

        <div>
            <label>Status</label>
            <select id="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="success">Success</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <div>
            <label>Tanggal Mulai</label>
            <input type="date" id="start_date" class="form-control">
        </div>

        <div>
            <label>Tanggal Selesai</label>
            <input type="date" id="end_date" class="form-control">
        </div>

        <button class="btn btn-primary ms-auto" id="btnFilter">Filter</button>

    </div>


    <!-- ============================
         TABLE SECTION
    ============================ -->
    <div class="page-section">

        <div class="table-modern mb-3">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="ordersTable"></tbody>
            </table>
        </div>

        <div id="pagination" class="mt-3"></div>

    </div>

</div>

<script src="../assets/js/orders.js"></script>

<?php include("../layout/footer.php"); ?>
