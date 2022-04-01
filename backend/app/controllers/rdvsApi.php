<?php
  class rdvsapi extends Controller {
    public function __construct(){
      $this->rdvModel = $this->model('Rdv');

      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json'); 
    }
    
    public function AllRdvs()
  {
    $rdvs = $this->rdvModel->getRdvs();
    echo json_encode($rdvs);
  }
  public function getRdvByDate($dateStr){
      $date = date($dateStr);
      echo  $date;
      $rdvs = $this->rdvModel->getRdvByDate($date);
      echo json_encode($rdvs);
  }

  public function Rdv($id)
  {
    $rdv = $this->rdvModel->getRdvById($id);
    echo json_encode($rdv);
  }
  
  public function RdvsByUser($id)
  {
    $rdv = $this->rdvModel->getRdvsByUser($id);
    echo json_encode($rdv);
  }

  public function updateRdv(){
    header('Acces-Control-Allow-Methods: PATCH');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    $postedData = json_decode(file_get_contents("php://input"));
    $data = [
      'id' => $postedData->id,
      'sujet_rdv' => $postedData->sujet_rdv,
      'id_err' => '',
      'sujet_rdv_err' => '',
    ];
    if (empty($data['id'])) {
      $data['id_err'] = 'x';
    }
    if (empty($data['sujet_rdv'])) {
      $data['sujet_rdv_err'] = 'x';
    }
    // Make sure no errors
    if (empty($data['id_err']) && empty($data['sujet_rdv_err'])) {
      // Validated
      if ($this->rdvModel->updateRdv($data)) {
        $arr = array(
          'message' => 'Rdv Updated'
        );
        echo json_encode($arr);
      } else {
        $arr = array(
          'message' => 'Something went wrong'
        );
        echo json_encode($arr);
      }
    } else {
      // Load view with errors
      $arr = array(
        'message' => 'No Data'
      );
      echo json_encode($arr);
    }
}
    

  public function addRdv()
  {
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    //Create the reference
      $postedData = json_decode(file_get_contents("php://input"));
      $data = [
        'sujet_rdv' => $postedData->sujet_rdv,
        'date_rdv' => $postedData->date_rdv,
        'creneau_rdv' => $postedData->creneau_rdv,
        'idClient' => $postedData->idClient,
        'idAdmin' => $postedData->idAdmin,
        'sujet_rdv_err' => '',
        'date_rdv_err' => '',
        'creneau_rdv_err' => '',
        'idClient_err' => '',
        'idAdmin_err' => ''
      ];
      if (empty($data['sujet_rdv'])) {
        $data['sujet_rdv_err'] = 'x';
      }
      if (empty($data['date_rdv'])) {
        $data['date_rdv_err'] = 'x';
      }
      if (empty($data['creneau_rdv'])) {
        $data['creneau_rdv_err'] = 'x';
      }
      if (empty($data['idClient'])) {
        $data['idClient_err'] = 'x';
      }
      if (empty($data['idAdmin'])) {
        $data['idAdmin_err'] = 'x';
      }
      

      // Make sure no errors
      if (empty($data['sujet_rdv_err']) && empty($data['date_rdv_err']) && empty($data['creneau_rdv_err']) && empty($data['idClient_err']) && empty($data['idAdmin_err'])) {
        // Validated
        if ($this->rdvModel->addRdv($data)){
          $arr = array(
            'message' => 'Rdv Added'
          );
          echo json_encode($arr);
        } else {
          $arr = array(
            'message' => 'Something went wrong'
          );
          echo json_encode($arr);
        }
      }
  }
    
  public function delete($id){
    header('Acces-Control-Allow-Methods: DELETE');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    if ($this->rdvModel->deleteRdv($id)) {
        $arr = array(
            'message' => 'rdv Deleted'
        );
        echo json_encode($arr);
    } else {
        $arr = array(
            'message' => 'Something went wrong'
        );
        echo json_encode($arr);
    }
  }
  }