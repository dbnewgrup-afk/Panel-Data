<?php include("../layout/header.php"); ?>
<?php include("../layout/sidebar.php"); ?>

<div class="container" style="max-width: 1100px;">

    <h3 class="mb-4">Callback Logs</h3>

    <!-- ============================
         LOG VIEWER
    ============================ -->
    <div class="page-section">

        <div class="log-box mb-3">
            <pre id="callbackLogText" class="log-view"></pre>
        </div>

    </div>

</div>

<script src="../assets/js/callback_logs.js"></script>

<?php include("../layout/footer.php"); ?>
