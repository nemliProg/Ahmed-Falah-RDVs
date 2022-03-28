<?php
  class API extends Controller {
    public function __construct(){
      $this->postModel = $this->model('Post');
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      
    }
    
    public function AllPosts()
  {
    $posts = $this->postModel->getPosts();
    echo json_encode($posts);
  }

  public function Post($id)
  {
    $post = $this->postModel->getPostById($id);
    echo json_encode($post);
  }

  public function AddPost()
  {
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
      $postedData = json_decode(file_get_contents("php://input"));
      $data = [
        'title' => $postedData->title,
        'body' => $postedData->body,
        'image' => $postedData->image,
        'user_id' => $postedData->user_id,
        'image_err' => '',
        'title_err' => '',
        'body_err' => ''
      ];
      if (empty($data['title'])) {
        $data['title_err'] = 'x';
      }
      if (empty($data['body'])) {
        $data['body_err'] = 'x';
      }
      if (empty($data['image'])) {
        $data['image_err'] = 'x';
      }

      // Make sure no errors
      if (empty($data['title_err']) && empty($data['body_err']) && empty($data['image_err'])) {
        // Validated
        if ($this->postModel->addPost($data)) {
          $arr = array(
            'message' => 'Post Added'
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
  

  }