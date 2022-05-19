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
    //get post by id
    public static function getPostById($post_id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :post_id");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // get all comments by post id
    public static function getCommentsByPostId($post_id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE postId = :post_id");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // get last comment by post id
    public static function getLastCommentByPostId($post_id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE postId = :post_id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // get last post from user id
    public static function getLastPostByUserId($user_id){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM posts WHERE userId = :user_id ORDER BY id DESC LIMIT 1");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // update description by post id
    public static function updateDescription($post_id, $description){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("UPDATE posts SET description = :description WHERE id = :post_id");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }
    // update users by post id
    public static function updateUsers($post_id, $users){
        $conn = Db::getInstance();
        $stmt = $conn->prepare("UPDATE posts SET users = :users WHERE id = :post_id");
        $stmt->bindParam(":post_id", $post_id);
        $stmt->bindParam(":users", $users);
        $stmt->execute();
    }




    




}

?>