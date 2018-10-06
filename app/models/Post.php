<?php
  class Post {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getPosts() {
      // Query to get all the posts in the database with the names
      // of their authors and the time they were created. 
      // The query would have to join the posts and users table
      // creating aliases for fields with similar names

      $sql = "SELECT `likes`, `title`, `body`, `name`, `posts`.`id` AS `postId`, `users`.`id` AS userId, `posts`.`created_at` AS postCreated 
              FROM `posts` INNER JOIN `users` WHERE `posts`.`user_id` = `users`.`id`
              ORDER BY `posts`.`created_at` DESC";

      $this->db->query($sql);
      // $this->db->execute();
      return $this->db->resultSet();
    }

    public function getUserPosts($user_id)
    {
      $sql = "SELECT *, `posts`.`id` AS `postId`, `posts`.`created_at` AS `postCreated` FROM posts WHERE user_id = :user_id ORDER BY posts.created_at DESC";
      $this->db->query($sql);
      $this->db->bind(":user_id", $user_id);
      return $this->db->resultSet();
    }

    public function addPost($data) {
      $sql = "INSERT INTO posts (user_id, title, body) 
              VALUES (:user_id, :title, :body)";
      // To prepare the sql statement
      $this->db->query($sql);
      // Bind the values
      $this->db->bind(":user_id", $data["user_id"]);
      $this->db->bind(":title", $data["title"]);
      $this->db->bind(":body", $data["body"]);
      // to Execute, method execute() returns NULL so code is going to be
      // written appropriately
      if ($this->db->execute()) {
        return true;
      } else {
          return false;
      }
      
    }

    public function updatePost($data) {
      $sql = "UPDATE posts SET title = :title, body= :body WHERE id = :id";
      $this->db->query($sql);
      // Bind Values
      $this->db->bind(":id", $data["id"]);
      $this->db->bind(":title", $data["title"]);
      $this->db->bind(":body", $data["body"]);

      $concl = ($this->db->execute()) ? true : false;
      return $concl;
    }

    public function deletePost($id) {
      $sql = "DELETE FROM posts WHERE id = :id";
      $this->db->query($sql);
      // Bind id
      $this->db->bind(":id", $id);
      $concl = ($this->db->execute()) ? true : false;
      return $concl;
    }

    public function getPostById($id) {
      $sql = "SELECT * FROM posts WHERE id = :id";
      $this->db->query($sql);

      // To Bind the values
      $this->db->bind(":id", $id);

      // return the entire row
      $row = $this->db->single();
      return $row;
    }

    public function getPostLikes($id)
    {
      $sql = "SELECT `likes` FROM `posts` WHERE `id`=:id";
      $this->db->query($sql);
      $this->db->bind(":id", $id);
      return $this->db->single()->likes;
    }

    public function getPostUserLikes($id)
    {
      $sql = "SELECT `name`,`user_id` AS `userId` FROM `users` INNER JOIN `likes` 
              ON `users`.`id`=`likes`.`user_id` WHERE `likes`.`post_id`=:id";
      $this->db->query($sql);
      $this->db->bind(":id", $id);
      return $this->db->resultSet();
    }

    public function addPostLike($id) 
    {
      $sql = "UPDATE `posts` SET `likes`=`likes`+1 WHERE `id`=:id";
      $this->db->query($sql);
      $this->db->bind(":id", $id);
      $update_bool= $this->db->execute();
      $query = "INSERT INTO `likes`(`post_id`, `user_id`)
                VALUES (:pid, :uid)";
      $this->db->query($query);
      $this->db->bind(":pid", $id);
      $this->db->bind(":uid", $_SESSION["user_id"]);
      $insert_bool = $this->db->execute();
      return ($insert_bool && $update_bool);
    }

    public function postExists($id)
    {
      $sql = "SELECT * FROM `posts` WHERE `id`=:id";
      $this->db->query($sql);
      $this->db->bind(":id", $id);
      return ($this->db->single() ? true : false);
    }

    public function removePostLike($id)
    {
      $sql = "UPDATE `posts` SET `likes`=`likes`-1 WHERE `id`=:id";
      $this->db->query($sql);
      $this->db->bind(":id", $id);
      $update_bool = $this->db->execute();
      $query = "DELETE FROM `likes` WHERE `post_id`=:pid AND `user_id`=:uid";
      $this->db->query($query);
      $this->db->bind(":pid", $id);
      $this->db->bind(":uid", $_SESSION['user_id']);
      $del_bool = $this->db->execute();
      return ($del_bool && $update_bool);
    }

    public function postPreviouslyLiked($id)
    {
      $sql = "SELECT * FROM `likes` WHERE `post_id`=:pid AND `user_id`=:uid";
      $this->db->query($sql);
      $this->db->bind(":pid", $id);
      $this->db->bind(":uid", $_SESSION['user_id']);
      return ($this->db->single() ? true : false);
    }
  }
 ?>
