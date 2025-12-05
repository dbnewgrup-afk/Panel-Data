<?php
require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../lib/Auth.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $this->db   = $db;
        $this->user = new UserModel($db);
    }

    /**
     * Login user
     */
    public function login()
    {
        $input = Helpers::input();
        $email = Helpers::clean($input['email'] ?? '');
        $pass  = $input['password'] ?? '';

        if (!$email || !$pass) {
            Helpers::json(['error' => true, 'message' => 'Email & password wajib diisi'], 400);
        }

        $user = $this->user->checkLogin($email, $pass);
        if (!$user) {
            Helpers::json(['error' => true, 'message' => 'Email atau password salah'], 401);
        }

        Auth::login($user['id']);

        Helpers::json(['error' => false, 'message' => 'Login berhasil']);
    }

    /**
     * Register user
     */
    public function register()
    {
        $input = Helpers::input();
        $name  = Helpers::clean($input['name'] ?? '');
        $email = Helpers::clean($input['email'] ?? '');
        $pass  = $input['password'] ?? '';

        if (!$name || !$email || !$pass) {
            Helpers::json(['error' => true, 'message' => 'Semua field wajib diisi'], 400);
        }

        if ($this->user->findByEmail($email)) {
            Helpers::json(['error' => true, 'message' => 'Email sudah terdaftar'], 400);
        }

        $this->user->create($name, $email, $pass);

        Helpers::json(['error' => false, 'message' => 'Register berhasil']);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        Helpers::json(['error' => false, 'message' => 'Logout berhasil']);
    }

    /**
     * Data user yang sedang login
     */
    public function me()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $user = $this->user->findById(Auth::id());

        // hapus password hash
        unset($user['password']);

        // pastikan plain_password ikut dikirim ke frontend
        // supaya UI profile bisa show/hide password
        $user['plain_password'] = $user['plain_password'] ?? '';

        Helpers::json([
            'error' => false,
            'data'  => $user
        ]);
    }
}
