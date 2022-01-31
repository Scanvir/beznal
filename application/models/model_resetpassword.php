<?php

class Model_ResetPassword extends Model
{

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function generateHash($password) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            $hash = crypt($password, $salt);
            return Array($hash, $salt);
        }
    }

    public function resetUserPassword($userId, $reset_hash)
    {
        $query = "UPDATE users SET reset_hash = '$reset_hash', reset_expires = DATE_ADD(NOW(), INTERVAL 2 HOUR) WHERE id = '$userId'";
        $stmt = $this->db->query($query);

        return $stmt;
    }

    public function checkUserEmail($email)
    {
        $query = "SELECT 1 isValid, personName, id FROM users WHERE email = '$email'";
        $stmt = $this->db->query($query);

        return $stmt;
    }
}