<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<div class="container" style="max-width: 1150px;">

    <h3 class="mb-4">Dashboard</h3>

    <!-- ============================
         DASHBOARD METRICS
    ============================ -->
    <div class="page-section">

        <div class="row g-3" id="dashboardStats">

            <div class="col-md-3 col-sm-6">
                <div class="metric-box text-center">
                    <div class="metric-label">Total Order</div>
                    <div class="metric-value" id="statTotal">0</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="metric-box text-center">
                    <div class="metric-label">Success</div>
                    <div class="metric-value" id="statSuccess">0</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="metric-box text-center">
                    <div class="metric-label">Pending</div>
                    <div class="metric-value" id="statPending">0</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="metric-box text-center">
                    <div class="metric-label">Failed</div>
                    <div class="metric-value" id="statFailed">0</div>
                </div>
            </div>

        </div>

    </div>


    <!-- ============================
         LATEST ORDERS
    ============================ -->
    <div class="page-section">

        <div class="page-title">Latest Orders</div>

        <div class="table-modern">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
                </thead>
                <tbody id="latestOrders"></tbody>
            </table>
        </div>

    </div>

</div>

<script src="../assets/js/dashboard.js"></script>

<?php include("../layout/footer.php"); ?>
