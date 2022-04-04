<?php
  class Rdv {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
    public function updateRdv($data){
      $this->db->query('UPDATE rdvs SET sujet_rdv = :sujet_rdv  WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':sujet_rdv', $data['sujet_rdv']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    
    public function addRdv($data){
      $this->db->query('INSERT INTO rdvs (sujet_rdv,date_rdv,creneau_rdv,idClient,idAdmin) VALUES(:sujet_rdv,:date_rdv,:creneau_rdv,:idClient,:idAdmin)');
      // Bind values
      $this->db->bind(':sujet_rdv', $data['sujet_rdv']);
      $this->db->bind(':date_rdv', $data['date_rdv']);
      $this->db->bind(':creneau_rdv', $data['creneau_rdv']);
      $this->db->bind(':idClient', $data['idClient']);
      $this->db->bind(':idAdmin', $data['idAdmin']);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get User by ID
    public function getRdvById($id){
      $this->db->query('SELECT r.* , c.nom , c.prenom
                        from rdvs r , client c 
                        WHERE r.id = :id');
      // Bind value
      $this->db->bind(':id', $id);
      $row = $this->db->single();
      return $row;
    }
     public function getRdvByDate($date){
          $this->db->query('SELECT r.* , c.nom , c.prenom
                        from rdvs r , client c 
                        WHERE r.idClient = c.id
                        and date_rdv= :date_rdv
                        Order By creneau_rdv ASC');
          // Bind value
          $this->db->bind(':date_rdv', $date);
          $rows = $this->db->resultSet();
          return $rows;
      }
 

  
  // public function getRdvs(){
  //   $this->db->query('SELECT * from rdvs');
  //   $results = $this->db->resultSet();
  //   return $results;
  // }



  //get all RDVs
  public function getRdvs(){
    $this->db->query('SELECT r.* , c.nom , c.prenom
                      from rdvs r , client c
                      where r.idClient = c.id');
    $results = $this->db->resultSet();
    return $results;
  }

  public function getRdvsByUser($id){
    $this->db->query('SELECT r.*
                      from rdvs r,client c
                      where c.id = r.idClient
                      and r.idClient = :id');
    $this->db->bind(':id', $id);
    $results = $this->db->resultSet();
    return $results;
  }
  

  //Delete client 
  public function deleteRdv($id){
    $this->db->query('DELETE FROM rdvs WHERE id = :id');                 
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