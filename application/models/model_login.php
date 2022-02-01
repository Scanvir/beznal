<?php

class Model_Login extends Model
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

    function verifyHash($password, $hash){
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkName($name)
    {
        if (strlen($name) >= 2) return true;
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

    public function checkUserEmail($email)
    {
        $query = "SELECT password_hash, id FROM users WHERE email = '$email'";
        $stmt = $this->db->query($query);

        return $stmt;
    }

    public function getUser($id)
    {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $stmt = $this->db->query($query);

        return $stmt;
    }

    public function register($login, $email, $password, $hash)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (login, email, password) VALUES (:login, :email, :password, :active, :hash)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':active', false, PDO::PARAM_BOOL);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
        return $result->execute();
    }
}