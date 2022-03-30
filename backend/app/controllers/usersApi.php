<?php
  class usersapi extends Controller {
    public $count = 0;
    public function __construct(){
      $this->userModel = $this->model('User');
      $this->adminModel = $this->model('Admin');
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json'); 
    }
    
    public function AllUsers()
  {
    $users = $this->userModel->getUsers();
    echo json_encode($users);
  }

  public function User($id)
  {
    $user = $this->userModel->getUserById($id);
    echo json_encode($user);
  }

  public function AddUser()
  {
    $this->count = $this->count + 1;
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    //Create the reference
      $postedData = json_decode(file_get_contents("php://input"));
      $ref = substr($postedData->nom, -1) . $this->count . substr($postedData->prefession, -1) . "Ja" . substr($postedData->prenom,-1,-3) . "Yo" . $postedData->age-3;
      
      $data = [
        'nom' => $postedData->nom,
        'prenom' => $postedData->prenom,
        'age' => $postedData->age,
        'prefession' => $postedData->prefession,
        'ref' => $ref,
        'nom_err' => '',
        'prenom_err' => '',
        'age_err' => '',
        'prefession_err' => ''
        
      ];
      if (empty($data['nom'])) {
        $data['nom_err'] = 'x';
      }
      if (empty($data['prenom'])) {
        $data['prenom_err'] = 'x';
      }
      if (empty($data['age'])) {
        $data['age_err'] = 'x';
      }
      if (empty($data['prefession'])) {
        $data['prefession_err'] = 'x';
      }
      

      // Make sure no errors
      if (empty($data['nom_err']) && empty($data['prenom_err']) && empty($data['age_err']) && empty($data['prefession_err'])) {
        // Validated
        if ($this->userModel->register($data)){
          $arr = array(
            'message' => 'User Added'
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
  public function updateUser(){
    header('Acces-Control-Allow-Methods: PUT');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    $postedData = json_decode(file_get_contents("php://input"));
    $data = [
      'id' => $postedData->id,
      'nom' => $postedData->nom,
      'prenom' => $postedData->prenom,
      'age' => $postedData->age,
      'prefession' => $postedData->prefession,
      'id_err' => '',
      'nom_err' => '',
      'prenom_err' => '',
      'age_err' => '',
      'prefession_err' => '',
      'id_err' => ''
    ];
    if (empty($data['nom'])) {
      $data['nom_err'] = 'x';
    }
    if (empty($data['prenom'])) {
      $data['prenom_err'] = 'x';
    }
    if (empty($data['age'])) {
      $data['age_err'] = 'x';
    }
    if(empty($data['prefession'])){
      $data['movieName_err'] = 'x';
    }
    if(empty($data['id'])){
      $data['id_err'] = 'x';
    }
    // Make sure no errors
    if (empty($data['nom_err']) && empty($data['prenom_err']) && empty($data['age_err']) && empty($data['prefession_err'])
    && empty($data['id_err'])) {
      // Validated
      if ($this->userModel->updateUser($data)) {
        $arr = array(
          'message' => 'User Updated'
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
    
public function delete($id){
  if ($this->userModel->deleteUser($id)) {
      $arr = array(
          'message' => 'User Deleted'
      );
      echo json_encode($arr);
  } else {
      $arr = array(
          'message' => 'Something went wrong'
      );
      echo json_encode($arr);
  }
}
public function login($ref){
  if($this->userModel->login($ref)) {
    $arr = array(
        'message' => 'User Exists'
    );
    echo json_encode($arr);
}else if($this->adminModel->login($ref)){
  $arr = array(
    'message' => 'Admin Exists'
);
echo json_encode($arr);
}else {
    $arr = array(
        'message' => 'Something went wrong'
    );
    echo json_encode($arr);
}
}
  }