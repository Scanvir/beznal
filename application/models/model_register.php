<?php

class Model_Register extends Model
{

    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function generateHash($password) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            return $hash;
        }
    }

    public function checkName($name)
    {
        if (strlen($name) >= 4) return true;
        else return false;
    }
    public function checkPassword($password)
    {
        if (strlen($password) >= 8) return true;
        else return false;
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else return false;
    }

    public function register($edrpou, $companyName, $personName, $phone, $email, $password_hash, $reset_hash)
    {
        $query = "INSERT INTO users (email, edrpou, companyName, personName, phone, password_hash, activate_hash, created_at) VALUES ('$email', '$edrpou', '$companyName', '$personName', '$phone', '$password_hash', '$reset_hash', Now())";
        $stmt = $this->db->query($query);
    }
}