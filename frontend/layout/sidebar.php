<!-- SIDEBAR -->
<aside class="sidebar">

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a data-title="Dashboard"
               class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"
               href="../views/dashboard.php">
               <i class="bi bi-speedometer2"></i>
               <span>Dashboard</span>
            </a>
        </li>

        <!-- Orders -->
        <li class="nav-item">
            <a data-title="Orders"
               class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>"
               href="../views/orders.php">
               <i class="bi bi-cart-check"></i>
               <span>Orders</span>
            </a>
        </li>

        <!-- Callback Logs -->
        <li class="nav-item">
            <a data-title="Callback Logs"
               class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'callback_logs.php' ? 'active' : ''; ?>"
               href="../views/callback_logs.php">
               <i class="bi bi-clock-history"></i>
               <span>Callback Logs</span>
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item">
            <a data-title="Settings"
               class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>"
               href="../views/settings.php">
               <i class="bi bi-gear"></i>
               <span>Settings</span>
            </a>
        </li>

        <!-- Profile -->
        <li class="nav-item">
            <a data-title="Profile"
               class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>"
               href="../views/profile.php">
               <i class="bi bi-person-circle"></i>
               <span>Profile</span>
            </a>
        </li>

        <hr class="my-3">

        <!-- Logout -->
        <li class="nav-item mt-1">
            <a data-title="Logout" class="nav-link logout-link" id="logoutSidebar">
               <i class="bi bi-box-arrow-right"></i>
               <span>Logout</span>
            </a>
        </li>

    </ul>

</aside>

<script>
document.getElementById("logoutSidebar").onclick = async () => {
    const res = await app.post("logout");
    if (!res.error) {
        window.location.href = "../views/login.php";
    }
};
</script>

<div class="content">
