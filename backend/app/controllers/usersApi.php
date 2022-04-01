<?php
class usersapi extends Controller
{
  public function __construct()
  {
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
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    //Create the reference
    $postedData = json_decode(file_get_contents("php://input"));
    $counter = $this->userModel->getLastUserId();

    $ref = "YJ_". $randomString .  "_DN_" . $counter+1;
    $hashed_ref = password_hash($ref,PASSWORD_DEFAULT);
    $data = [
      'nom' => $postedData->nom,
      'prenom' => $postedData->prenom,
      'age' => $postedData->age,
      'prefession' => $postedData->prefession,
      'ref' => $hashed_ref,
      'idAdmin'=> 1,
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
      if ($this->userModel->register($data)) {
        $arr = array(
          'message' => 'User Added',
          'reference' => $ref
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
  public function updateUser()
  {
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
    if (empty($data['prefession'])) {
      $data['movieName_err'] = 'x';
    }
    if (empty($data['id'])) {
      $data['id_err'] = 'x';
    }
    // Make sure no errors
    if (
      empty($data['nom_err']) && empty($data['prenom_err']) && empty($data['age_err']) && empty($data['prefession_err'])
      && empty($data['id_err'])
    ) {
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

  public function delete($id)
  {
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
  public function login()
  {
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
    $postedData = json_decode(file_get_contents("php://input"));
    $data = [
      'ref' => $postedData->ref
    ];

    if ($this->adminModel->login($data['ref']) != false) {
      echo json_encode($this->adminModel->login($data['ref']));
    } else if ($this->userModel->login($data['ref']) != false) {
      echo json_encode($this->userModel->login($data['ref']));
    } else {
      $arr = array(
        'message' => 'Something went wrong'
      );
      echo json_encode($arr);
    }
  }
}
