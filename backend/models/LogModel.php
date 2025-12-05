<?php
/**
 * LogModel.php
 * Menyimpan log order (DB) dan log callback Digiflazz (file)
 */

class LogModel
{
    private $db;
    private $table = "order_logs";
    private $filePath;

    public function __construct($db)
    {
        $this->db = $db;
        $this->filePath = __DIR__ . '/../storage/logs/callback.log';

        // pastikan folder logs ada
        $logDir = dirname($this->filePath);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
    }

    /**
     * Simpan log DB per order
     * @param int $orderId
     * @param string $source: digiflazz|tokoku|system
     * @param string $type: callback|request|response
     * @param array $payload
     */
    public function saveOrderLog($orderId, $source, $type, $payload)
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
            (order_id, source, type, payload, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ");

        return $stmt->execute([
            $orderId,
            $source,
            $type,
            json_encode($payload)
        ]);
    }

    /**
     * Simpan raw callback ke file
     */
    public function saveCallbackFile($payload)
    {
        $line = "[" . date('Y-m-d H:i:s') . "] " . json_encode($payload) . PHP_EOL;
        @file_put_contents($this->filePath, $line, FILE_APPEND);
    }

    /**
     * Ambil log per order dari DB
     */
    public function getOrderLogs($orderId)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE order_id = ?
            ORDER BY id DESC
        ");
        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil daftar log terbaru (untuk UI Callback Logs)
     */
    public function getRecentLogs()
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            ORDER BY id DESC
            LIMIT 50
        ");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil isi file log callback (raw file)
     */
    public function getCallbackFileLog()
    {
        if (!file_exists($this->filePath)) {
            return "";
        }

        return file_get_contents($this->filePath);
    }
}
