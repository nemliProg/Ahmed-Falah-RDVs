<?php
class Admin {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function login($ref){
        $this->db->query('SELECT * FROM admin WHERE ref = :ref');
        $this->db->bind(':ref', $ref);
        $row = $this->db->single();      
        if($this->db->rowCount() > 0){
          return $row;
        } else {
          return false;
        }
      }
    
























}