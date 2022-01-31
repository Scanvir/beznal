<?php

class Database {

    public static $host = 'localhost';
    public static $dbname = 'beznalRomashka';
    public static $user = 'beznalRomashka';
    public static $pass = '20082408RomashkaBila';

    private static function connect() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8", self::$user, self::$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $param = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($param);
        if(explode(' ', $query)[0] == 'SELECT'){
            $data = $statement->fetchAll();
            return $data;
        }
    }
}