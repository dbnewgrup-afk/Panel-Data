<?php
/**
 * SettingModel.php
 * Menyimpan semua setting API & konfigurasi integrasi.
 * Struktur berbasis key-value.
 */

class SettingModel
{
    private $db;
    private $table = "settings";

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Ambil satu setting: return hanya value
     */
    public function get($key)
    {
        $stmt = $this->db->prepare("SELECT value FROM {$this->table} WHERE `key` = ? LIMIT 1");
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['value'] ?? null;
    }

    /**
     * Ambil seluruh setting dalam bentuk key → value
     */
    public function getAll()
    {
        $stmt = $this->db->query("SELECT `key`, `value` FROM {$this->table}");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $result[$row['key']] = $row['value'];
        }

        return $result;
    }

    /**
     * Update atau insert setting (UPSERT)
     */
    public function set($key, $value)
    {
        // sanitasi minimal
        $key   = trim($key);
        $value = trim((string)$value);

        // MySQL UPSERT
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (`key`, `value`, created_at, updated_at)
            VALUES (?, ?, NOW(), NOW())
            ON DUPLICATE KEY UPDATE
                value = VALUES(value),
                updated_at = NOW()
        ");

        return $stmt->execute([$key, $value]);
    }
}
