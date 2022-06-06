<?php

    
include_once("config.php");
class User{
    private $conn;
    private $name;
    private $email;

    //public static function that gets all users except user id session id
    public static function getAllUsersMatch($id){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT * FROM `users` WHERE `unique_id` != $id;");
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }
    public static function getAllMatch($id){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT * FROM `matches` WHERE `match_id` = $id;");
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
  }

    
    //public static function that gets firstname from all users
    public static function getAllUsers(){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    //get all users id from users
    public static function getAllUsersId(){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT unique_id FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    //public static function get user geo by user id
    public static function getUserGeo($id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]['geo'];
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
    //get user by Unique_id 
    public static function getUserByUniqueId($id){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = :id");
      $stmt->bindValue(":id", $id);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }
    //get all matches by userID
    public static function getAllMatches($id){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT match_id FROM matches WHERE user_id = :id");
      $stmt->bindValue(":id", $id);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }
    //get all common intrests by 2 usres from database
    public static function getCommonInterests($id1){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT tags FROM users WHERE unique_id = :id1 ");
      $stmt->bindValue(":id1", $id1);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return json_decode($result[0]['tags']);
    }
    public static function getEmoji($intrest){
      $conn = Db::getInstance();
      $stmt = $conn->prepare("SELECT * FROM intrest WHERE intrest = :intrest");
      $stmt->bindParam(":intrest", $intrest);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
  }


    




}

?>