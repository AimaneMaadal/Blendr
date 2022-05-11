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
    function calculateDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
      
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
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

    




}

?>