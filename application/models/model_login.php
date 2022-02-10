<?php

class Model_Login extends Model
{

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function verifyHash($password, $hash){
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserEmail($email)
    {
        $query = "SELECT password_hash, id FROM users WHERE email = '$email'";
        $stmt = $this->db->query($query);

        return $stmt;
    }
}