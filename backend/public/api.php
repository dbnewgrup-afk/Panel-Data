<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/db.php';

require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../lib/Auth.php';

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/SettingController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ . '/../controllers/CallbackController.php';

$action = $_GET['action'] ?? null;

if (!$action) {
    Helpers::json(['error' => true, 'message' => 'Action is required'], 400);
}

/**
 * SESSION hanya untuk endpoint yang butuh login
 * callback provider = TIDAK pakai session
 */
if ($action !== 'callback.provider') {
    session_start();
}

// Controllers
$auth     = new AuthController($db);
$user     = new UserController($db);
$setting  = new SettingController($db);
$order    = new OrderController($db);
$callback = new CallbackController($db);

switch ($action) {

    /* ======================
       AUTH
    ======================= */
    case 'login':           $auth->login(); break;
    case 'register':        $auth->register(); break;
    case 'logout':          $auth->logout(); break;
    case 'me':              $auth->me(); break;

    /* ======================
       USER
    ======================= */
    case 'profile.update':  $user->updateProfile(); break;
    case 'password.update': $user->updatePassword(); break;

    /* ======================
       SETTINGS
    ======================= */
    case 'settings.get':    $setting->get(); break;
    case 'settings.update': $setting->update(); break;

    /* ======================
       ORDERS
    ======================= */
    case 'orders.create':   $order->create(); break;
    case 'orders.list':     $order->list(); break;
    case 'orders.detail':   $order->detail(); break;
    case 'orders.retry':    $order->retry(); break;

    /* ======================
       DASHBOARD
    ======================= */
    case 'dashboard.stats': $order->dashboardStats(); break;

    /* ======================
       CALLBACK PROVIDER
    ======================= */
    case 'callback.provider':
        $callback->handle();
        break;

    /* ======================
       CALLBACK LOGS UI
    ======================= */
    case 'callback.logs':
        $callback->logs();
        break;

    default:
        Helpers::json(['error' => true, 'message' => 'Unknown action'], 404);
}
