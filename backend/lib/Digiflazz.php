<?php
/**
 * Digiflazz.php
 * Utility untuk generate & validasi signature Digiflazz.
 * Digiflazz hanya mengirim callback inbound (tidak ada outbound order).
 *
 * Format:
 * signature = md5(username + api_key + ref_id)
 */

require_once __DIR__ . '/../models/SettingModel.php';

class Digiflazz
{
    private $db;
    private $username;
    private $apiKey;

    public function __construct($db)
    {
        $this->db = $db;

        $setting = new SettingModel($db);
        $this->username = $setting->get('digiflazz_username');
        $this->apiKey   = $setting->get('digiflazz_api_key');
    }

    /**
     * Generate signature untuk satu ref_id
     */
    public function generateSignature($refId)
    {
        return md5($this->username . $this->apiKey . $refId);
    }

    /**
     * Validasi signature callback Digiflazz
     * payload harus mengandung: ref_id + signature
     */
    public function validateCallback($payload)
    {
        if (!isset($payload['ref_id']) || !isset($payload['signature'])) {
            return false;
        }

        $refId            = $payload['ref_id'];
        $incomingSignature = $payload['signature'];

        $localSignature = $this->generateSignature($refId);

        return strtolower($localSignature) === strtolower($incomingSignature);
    }
}
