<?php
require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/LogModel.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../lib/Config.php';


class CallbackController
{
    private $db;
    private $order;
    private $log;

    public function __construct($db)
    {
        $this->db    = $db;
        $this->order = new OrderModel($db);
        $this->log   = new LogModel($db);
    }

    public function handle()
    {
        $config = Config::load($this->db);
        
        /** 1. Wajib POST */
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::json(['error' => true, 'message' => 'Method Not Allowed'], 405);
        }

        /** 2. Ambil RAW body */
        $raw = file_get_contents("php://input");

        /** 3. Ambil signature dari header */
        $signatureHeader = $_SERVER['HTTP_X_SIGNATURE'] ?? null;
        $expected = hash_hmac('sha1', $raw, $config['digiflazz_secret']);

        /** 4. Validasi signature */
        if (!$signatureHeader || !hash_equals($expected, $signatureHeader)) {
            $this->log->saveCallbackFile("INVALID SIGNATURE\n".$raw);
            Helpers::json(['error' => true, 'message' => 'Invalid signature'], 401);
        }

        /** 5. Decode JSON */
        $input = json_decode($raw, true);

        if (!is_array($input)) {
            $this->log->saveCallbackFile("INVALID JSON\n".$raw);
            Helpers::json(['error' => true, 'message' => 'Invalid JSON'], 400);
        }

        /** 6. Simpan RAW log (valid request) */
        $this->log->saveCallbackFile($raw);

        /** 7. Ambil ref_id & status */
        $refId  = $input['ref_id'] ?? ($input['data']['ref_id'] ?? null);
        $status = $input['status'] ?? ($input['data']['status'] ?? null);

        if (!$refId || !$status) {
            Helpers::json(['error' => true, 'message' => 'Invalid payload'], 400);
        }

        /** 8. Normalize status */
        $status = $this->normalizeStatus($status);

        /** 9. Cari order */
        $order = $this->order->findByRefId($refId);
        if (!$order) {
            Helpers::json(['error' => true, 'message' => 'Order not found'], 404);
        }

        /** 10. Idempotent final status */
        if ($this->isFinalStatus($order['status'])) {
            $this->log->saveOrderLog($order['id'], 'callback', 'duplicate', $input);
            Helpers::json([
                'error'   => false,
                'message' => 'Duplicate callback ignored'
            ]);
        }

        /** 11. Update status */
        $this->order->updateStatusAtomic($order['id'], $status);

        /** 12. Simpan log inbound */
        $this->log->saveOrderLog($order['id'], 'callback', 'inbound', $input);

        /** 13. Response */
        Helpers::json([
            'error'    => false,
            'message'  => 'Callback processed',
            'order_id' => $order['id'],
            'status'   => $status
        ]);
    }

    private function normalizeStatus($status)
    {
        $s = strtolower(trim($status));
        return match ($s) {
            'success', 'sukses', 'berhasil' => 'success',
            'failed', 'gagal'                => 'failed',
            default                          => 'pending'
        };
    }

    private function isFinalStatus($status)
    {
        $s = strtolower($status);
        return in_array($s, ['success', 'failed']);
    }

    /* ===========================
       LOG LIST FOR UI
    ============================ */
    public function logs()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $orderId = $_GET['order_id'] ?? null;
        $source  = $_GET['source'] ?? null;

        // RAW FILE LOG
        if ($source === 'file') {
            $data = $this->log->getCallbackFileLog();
            Helpers::json([
                'error' => false,
                'type'  => 'file',
                'data'  => $data
            ]);
        }

        // PER ORDER LOG
        if ($orderId) {
            $logs = $this->log->getOrderLogs($orderId);
            Helpers::json([
                'error'    => false,
                'type'     => 'order',
                'order_id' => $orderId,
                'data'     => $logs
            ]);
        }

        // LIST ALL RECENT
        $logs = $this->log->getRecentLogs();
        Helpers::json([
            'error' => false,
            'type'  => 'list',
            'data'  => $logs
        ]);
    }
}
