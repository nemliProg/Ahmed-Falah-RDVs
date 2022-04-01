<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO client (nom,prenom,age,prefession,ref,idAdmin) VALUES(:nom,:prenom,:age,:prefession,:ref,:idAdmin)');
      // Bind values
      $this->db->bind(':nom', $data['nom']);
      $this->db->bind(':prenom', $data['prenom']);
      $this->db->bind(':age', $data['age']);
      $this->db->bind(':prefession', $data['prefession']);
      $this->db->bind(':ref', $data['ref']);
      $this->db->bind(':idAdmin', $data['idAdmin']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    // Login User
    public function login($ref){
      $this->db->query('SELECT * FROM client WHERE id = :id');
      $id = intval(substr($ref,27));
      $this->db->bind(':id',$id);
      $row = $this->db->single();
      if(password_verify($ref,$row->ref)){
        return $row;
      } else {
        return false;
      }
    }

    // Get User by ID
    public function getUserById($id){
      $this->db->query('SELECT * FROM client WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }
    public function getLastUserId(){
      $this->db->query('SELECT id FROM client order by id desc limit 1');
      // Bind value
      $row = $this->db->single();
      return $row->id;
    }
 
  //Update client 
  public function updateUser($data){
    $this->db->query('UPDATE client SET nom = :nom, prenom = :prenom , age = :age , prefession = :prefession  WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':nom', $data['nom']);
    $this->db->bind(':prenom', $data['prenom']);
    $this->db->bind(':age', $data['age']);
    $this->db->bind(':prefession', $data['prefession']);
    // Execute
    if($this->db->execute()){
      return true;
    } else {
      return false;
    }
  }
//get all clients 
public function getUsers(){
  $this->db->query('SELECT * from client');
  $results = $this->db->resultSet();
  return $results;
}
//Delete client 
public function deleteUser($id){
  $this->db->query('DELETE FROM client WHERE id = :id');                 
  // Bind values
  $this->db->bind(':id',$id);
  // Execute
  if($this->db->execute()){
    return true;
  } else {
    return false;
  }
}
}