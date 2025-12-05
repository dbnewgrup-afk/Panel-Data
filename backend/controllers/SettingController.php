<?php
require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../lib/Auth.php';
require_once __DIR__ . '/../models/SettingModel.php';

class SettingController
{
    private $db;
    private $setting;

    public function __construct($db)
    {
        $this->db      = $db;
        $this->setting = new SettingModel($db);
    }

    /**
     * Ambil semua setting
     */
    public function get()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        // Ambil setting dari database
        $data = $this->setting->getAll();

        /**
         * Kalau mau API URL jadi readonly dari database:
         * tidak perlu pakai Helpers::config
         */
        $data['webhook_url'] = Helpers::baseUrl() . '/backend/public/callback/digiflazz.php';

        Helpers::json(['error' => false, 'data' => $data]);
    }

    /**
     * Update setting (hanya credential)
     */
    public function update()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $input = Helpers::input();

        // whitelist yang bisa diubah
        $allowed = [
            'digiflazz_username',
            'digiflazz_api_key',
            'tokoku_client_id',
            'tokoku_client_secret',
            'tokoku_api_url'
        ];

        foreach ($allowed as $key) {
            if (isset($input[$key])) {
                $value = trim($input[$key]);
                $this->setting->set($key, $value);
            }
        }

        Helpers::json(['error' => false, 'message' => 'Setting diperbarui']);
    }
}
