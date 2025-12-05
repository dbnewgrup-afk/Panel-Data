<?php
require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../lib/Auth.php';
require_once __DIR__ . '/../lib/Tokoku.php';
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/LogModel.php';
require_once __DIR__ . '/../lib/Config.php';


class OrderController
{
    private $db;
    private $order;
    private $log;
    private $tokoku;

public function __construct($db)
{
    $this->db     = $db;
    $this->order  = new OrderModel($db);
    $this->log    = new LogModel($db);
    $this->tokoku = new Tokoku($db); // HANYA ini
    $this->config = Config::load($db); // Boleh tetap ada kalau buat hal lain
}

    /**
     * List order user
     */
    public function list()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $input = $_GET;
        $userId = Auth::id();

        $search = $input['search'] ?? null;
        $status = $input['status'] ?? null;
        $sd     = $input['start_date'] ?? null;
        $ed     = $input['end_date'] ?? null;
        $page   = max(1, (int)($input['page'] ?? 1));
        $limit  = 10;
        $offset = ($page - 1) * $limit;

        $data = $this->order->list($userId, $search, $status, $sd, $ed, $limit, $offset);

        Helpers::json(['error' => false, 'data' => $data]);
    }

    /**
     * Detail order + logs
     */
    public function detail()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true], 401);
        }

        $id = $_GET['id'] ?? 0;

        $data = $this->order->detail(Auth::id(), $id);
        if (!$data) {
            Helpers::json(['error' => true, 'message' => 'Order tidak ditemukan'], 404);
        }

        $logs = $this->log->getOrderLogs($id);

        Helpers::json([
            'error' => false,
            'data'  => $data,
            'logs'  => $logs
        ]);
    }

    /**
     * Retry order ke Tokoku
     */
    public function retry()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true], 401);
        }

        $id = $_GET['id'] ?? 0;
        $order = $this->order->detail(Auth::id(), $id);

        if (!$order) {
            Helpers::json(['error' => true, 'message' => 'Order tidak ditemukan'], 404);
        }

        if ($order['status'] !== 'failed') {
            Helpers::json(['error' => true, 'message' => 'Order tidak bisa diretry'], 400);
        }

        // payload minimum Tokoku
        $payload = [
            'ref_id'        => $order['digiflazz_ref'],
            'product_code'  => $order['product_code'],
            'target'        => $order['target_number'],
            'price_selling' => $order['price_selling']
        ];

        // Log request outbound
        $this->log->saveOrderLog($id, 'tokoku', 'request', $payload);

        $response = $this->tokoku->retryOrder($payload);

        // Log response inbound
        $this->log->saveOrderLog($id, 'tokoku', 'response', $response);

        // Update status (minimal) bila HTTP ok
        if (is_array($response) && isset($response['status']) && ((int)$response['status']) === 200) {
            $this->order->updateStatus($id, 'processing');
        }

        Helpers::json([
            'error' => false,
            'message' => 'Retry dikirim',
            'response' => $response
        ]);
    }

    /**
     * Dashboard summary
     */
    public function dashboardStats()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true], 401);
        }

        $summary = $this->order->countSummary(Auth::id());

        Helpers::json([
            'error' => false,
            'data'  => $summary
        ]);
    }

public function create()
{
    if (!Auth::check()) {
        Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
    }

    $input = Helpers::input();
    $userId = Auth::id();

    foreach (['product_code','target_number','price_selling'] as $r) {
        if (empty($input[$r])) {
            Helpers::json(['error' => true, 'message' => "Field {$r} wajib"], 422);
        }
    }

    $ref = 'DFZ-' . time() . '-' . Helpers::random(6);

    $orderId = $this->order->create([
        'user_id'       => $userId,
        'product_code'  => $input['product_code'],
        'target_number' => $input['target_number'],
        'price_cost'    => $input['price_selling'],
        'price_selling' => $input['price_selling'],
        'status'        => 'pending',
        'digiflazz_ref' => $ref,
        'tokoku_ref'    => null
    ]);

    $payload = [
        'ref_id'        => $ref,
        'product_code'  => $input['product_code'],
        'target'        => $input['target_number'],
        'price_selling' => $input['price_selling']
    ];

    $this->log->saveOrderLog($orderId, 'tokoku', 'request', $payload);

    $response = $this->tokoku->sendOrder($payload);

    $this->log->saveOrderLog($orderId, 'tokoku', 'response', $response);

    // kalau provider kasih ref tokoku
    if (is_array($response) && isset($response['ref_id'])) {
        $this->order->updateTokokuRef($orderId, $response['ref_id']);
        $this->order->updateStatus($orderId, 'processing');
    }

    Helpers::json([
        'error' => false,
        'message' => 'Order dikirim',
        'order_id' => $orderId,
        'ref_id' => $ref,
        'response' => $response
    ]);
}

}
