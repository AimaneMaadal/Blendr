<?php

    
include_once("config.php");
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
    //public static function get all users where id = $id with bind values
    public static function getUserById($id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //bind
    




}

?>