<?php
require_once __DIR__ . '/../lib/Helpers.php';
require_once __DIR__ . '/../lib/Auth.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $this->db   = $db;
        $this->user = new UserModel($db);
    }

    /**
     * Update profil (nama)
     */
    public function updateProfile()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $input = Helpers::input();
        $name  = Helpers::clean($input['name'] ?? '');

        if (!$name) {
            Helpers::json(['error' => true, 'message' => 'Nama tidak boleh kosong'], 400);
        }

        $this->user->updateName(Auth::id(), $name);

        Helpers::json(['error' => false, 'message' => 'Profil berhasil diperbarui']);
    }

    /**
     * Update password
     */
    public function updatePassword()
    {
        if (!Auth::check()) {
            Helpers::json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        $input = Helpers::input();
        $pw    = $input['password'] ?? '';
        $pw2   = $input['password_confirm'] ?? '';

        if (!$pw || !$pw2) {
            Helpers::json(['error' => true, 'message' => 'Password wajib diisi'], 400);
        }

        if ($pw !== $pw2) {
            Helpers::json(['error' => true, 'message' => 'Password tidak sama'], 400);
        }

        $this->user->updatePassword(Auth::id(), $pw);

        Helpers::json(['error' => false, 'message' => 'Password berhasil diubah']);
    }


}
