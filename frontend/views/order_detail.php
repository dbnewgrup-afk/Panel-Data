<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<h3 class="mb-4">Order Detail</h3>

<div class="card p-4">
    <table class="table">
        <tr><th>ID</th><td id="od_id"></td></tr>
        <tr><th>Product</th><td id="od_product"></td></tr>
        <tr><th>Target</th><td id="od_target"></td></tr>
        <tr><th>Harga Modal</th><td id="od_cost"></td></tr>
        <tr><th>Harga Jual</th><td id="od_selling"></td></tr>
        <tr><th>Status</th><td id="od_status"></td></tr>
        <tr><th>Ref Digiflazz</th><td id="od_ref_digi"></td></tr>
        <tr><th>Ref Tokoku</th><td id="od_ref_tokoku"></td></tr>
        <tr><th>Dibuat</th><td id="od_created"></td></tr>
    </table>

    <button class="btn btn-warning" id="btnRetry" style="display:none;">Retry Order</button>
</div>

<h4 class="mt-5">Order Logs</h4>
<div class="card p-4 mt-3">
    <pre id="orderLogs" class="bg-light p-3" style="height:300px; overflow:auto;"></pre>
</div>

<script src="../assets/js/order_detail.js"></script>

<?php include("../layout/footer.php"); ?>
