<?php

    
include_once("config.php");
class User{
    private $conn;
    private $title;
    private $users;


    
    //public static function that gets firstname from all users
    public static function getAllPosts(){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }



    




}

?>