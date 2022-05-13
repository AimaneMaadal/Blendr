<?php

    
include_once("config.php");

class Post{
    
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
    //check if user id contains in table post_likes
    public static function checkIfUserLikedPost($user_id, $post_id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM post_likes WHERE userid = :user_id AND postid = :post_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0){
            return true;
        }
        return false;
    }



    




}

?>