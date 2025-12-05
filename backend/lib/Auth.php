<?php
/**
 * Auth.php
 * Manajemen autentikasi berbasis session
 */

class Auth
{
    /**
     * Memastikan session sudah berjalan
     */
    private static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Login: simpan user_id ke session
     */
    public static function login($userId)
    {
        self::start();
        $_SESSION['user_id'] = $userId;
    }

    /**
     * Logout: hapus session
     */
    public static function logout()
    {
        self::start();
        session_destroy();
    }

    /**
     * Apakah user sudah login?
     */
    public static function check()
    {
        self::start();
        return isset($_SESSION['user_id']);
    }

    /**
     * Ambil id user yang sedang login
     */
    public static function id()
    {
        self::start();
        return $_SESSION['user_id'] ?? null;
    }
}
