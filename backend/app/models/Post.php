<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPosts(){
      $this->db->query('SELECT p.*,u.first_name,u.last_name 
                        FROM posts p,users u 
                        WHERE p.user_id = u.user_id
                        ORDER By p.published_at DESC ');
      $results = $this->db->resultSet();

      
      return $results;
    }

    public function addPost($data){
      $this->db->query('INSERT INTO posts (title,post_body,image,likes,comments, user_id) VALUES(:title,:post_body,:image,:likes,:comments,:user_id)');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':post_body', $data['body']);
      $this->db->bind(':image', $data['image']);
      $this->db->bind(':likes', 0);
      $this->db->bind(':comments', 0);
      $this->db->bind(':user_id', $data['user_id']);
      
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updatePost($data){
      $this->db->query('UPDATE posts SET title = :title, post_body = :post_body, image = :image WHERE post_id = :post_id');
      // Bind values
      $this->db->bind(':post_id', $data['post_id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':post_body', $data['body']);
      $this->db->bind(':image', $data['image']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getPostById($id){
      $this->db->query('SELECT * FROM posts WHERE post_id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE user_id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }
    
    public function verifyUserIfLikesPost($idUser,$idPost){
      $this->db->query('SELECT count(*) AS "number" FROM postLikes WHERE user_id = :idUser AND post_id = :idPost');
      $this->db->bind(':idPost', $idPost);
      $this->db->bind(':idUser', $idUser);

      $row = $this->db->single();

      return $row;
    }

    public function deletePost($id){
      $this->db->query('DELETE FROM posts WHERE post_id = :post_id');
      // Bind values
      $this->db->bind(':post_id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }



    public function like($data)
    {
      if ($data['ifExist'] > 0) {
        $this->db->query('DELETE FROM postLikes WHERE post_id = :post_id AND user_id =:user_id');

      } else {
        $this->db->query('INSERT INTO postLikes (post_id,user_id) VALUES (:post_id,:user_id)');
      }
      
      // Bind values
      $this->db->bind(':post_id', $data['post_id']);
      $this->db->bind(':user_id', $data['user_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


  }