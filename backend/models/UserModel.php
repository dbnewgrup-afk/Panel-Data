<?php
/**
 * UserModel.php
 * Mengelola data user (login, update profil, update password).
 */

class UserModel
{
    private $db;
    private $table = "users";

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkLogin($email, $password)
    {
        $user = $this->findByEmail($email);
        if (!$user) return false;

        if (!password_verify($password, $user['password'])) return false;

        return $user;
    }

    public function create($name, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (name, email, password, plain_password, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())
        ");

        return $stmt->execute([$name, $email, $hash, $password]);
    }

    /**
     * Update nama user
     */
    public function updateName($id, $name)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} 
            SET name = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    /**
     * Update password user + plain password
     */
    public function updatePassword($id, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET password = ?, plain_password = ?, updated_at = NOW() 
            WHERE id = ?
        ");

        return $stmt->execute([$hash, $password, $id]);
    }
}
