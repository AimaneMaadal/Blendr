<?php

    
include_once(__DIR__ . "/config.php");
class User{
    private $conn;
    private $name;
    private $email;

    
    //public static function that gets firstname from all users
    public static function getAllUsers(){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }



}

?>