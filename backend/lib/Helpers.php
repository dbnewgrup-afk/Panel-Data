<?php
/**
 * Helpers.php
 * Kumpulan fungsi utilitas kecil untuk controller & model
 */

class Helpers
{
    /**
     * Output JSON + hentikan script
     */
    public static function json($data = [], $httpCode = 200)
    {
        http_response_code($httpCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Ambil input POST/JSON secara aman
     */
    public static function input()
    {
        if (!empty($_POST)) {
            return $_POST;
        }

        $raw  = file_get_contents("php://input");
        $json = json_decode($raw, true);

        return $json ?: [];
    }

    /**
     * Sanitize string basic
     */
    public static function clean($str)
    {
        return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Format tanggal standar
     */
    public static function date($timestamp)
    {
        return date('Y-m-d H:i:s', strtotime($timestamp));
    }

    /**
     * Random string generator
     */
    public static function random($length = 16)
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Global config
     */
    public static function config($key)
    {
        // NOTE:
        // kalau nanti mau pindah server, cukup ubah ini
        $config = [
            'APP_URL'        => 'http://localhost/PANEL-DATA',
            'TOKOKU_API_URL' => 'https://api.tokoku.id/order'
        ];

        return $config[$key] ?? null;
    }

    /**
     * Base URL helper
     */
    public static function baseUrl()
    {
        return self::config('APP_URL');
    }
}
