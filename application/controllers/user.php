<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -  
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in 
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function login()
  {
    $this->load->model('users');
    $result = $this->users->login($_POST);
    switch($result['status']) {
      case "SUCCESS":
        $this->session->set_userdata("user", $result['user']);
        break;
      case "FAIL":
        $this->session->set_userdata("login_error", $result['login_error']);
        break;      
    }
    if(array_key_exists("redirect_to", $_POST)) {
      redirect($_POST['redirect_to']);
    } else {
      // echo var_dump($result);
      redirect("welcome");
    }
  }

  public function logout() {
    $this->session->unset_userdata("user");
    if(array_key_exists("redirect_to", $_GET)) {
      redirect($_GET['redirect_to']);
    } else {
      redirect("welcome"); 
    }
  }

  public function do_post() {
    $this->load->model('user_post');
    $user = $this->session->userdata("user");
    $input = array();
    $input['user_id'] = $user->id;
    $input['post_text'] = $_POST['post'];
    $input['ip'] = $_SERVER['REMOTE_ADDR'];
    $this->user_post->insert_entry($input);
    redirect('/');
  }

  public function do_comment($post_id = NULL) {
    $user = $this->session->userdata("user");
    if($post_id != NULL && $user != NULL) {
      $input = array('post_id' => $post_id);
      $input['comment'] = $_POST['comment'];
      $input['user_id'] = $user->id;
      $input['ip'] = $_SERVER['REMOTE_ADDR'];
      $this->load->model('user_post_comment');
      $comment_id = $this->user_post_comment->insert_entry($input);
      $comment = $this->user_post_comment->get_comment($comment_id);
      $retArr = array(
        'comment'   => $comment->comment,
        'time'      => $comment->comment_at,
        'user_name' => $user->name
        );
      echo json_encode(array('status'=>"SUCCESS", 'list'=> array($retArr)));
    }
  }

  public function list_comment($post_id = NULL, $more = 0)
  {
    if($post_id != NULL) {
      $this->load->model('user_post_comment');
      $list = $this->user_post_comment->get_comments_for_post($post_id, $more);
      echo json_encode(array('status'=>"SUCCESS", 'list'=>$list));
    }
  }

  public function post_like($post_id = NULL)
  {
    $user = $this->session->userdata("user");
    $ajaxRes = array();
    if($user == NULL)
    {
      $ajaxRes['status'] = "FAIL";
      $ajaxRes['data'] = "Login required.";
    } else {
      if($post_id != NULL)
      {
        $this->load->model('user_post_like');
        $like = $this->user_post_like->toggle_like($user->id, $post_id);
        $ajaxRes['status'] = "SUCCESS";
        $ajaxRes['data'] = $like;
      }
      else 
      {
        $ajaxRes['status'] = "FAIL";
        $ajaxRes['data'] = "Unexpected situation, please contact developer about this error";
      }
    }
    echo json_encode($ajaxRes);
  }

  public function remove_post($post_id = NULL) 
  {
    $user = $this->session->userdata("user");
    $ajaxRes = array();
    if($user == NULL)
    {
      $ajaxRes['status'] = "FAIL";
      $ajaxRes['data'] = "Login required.";
    } else {
      if($post_id != NULL)
      {
        $this->load->model('user_post_remove');
        $remove = $this->user_post_remove->toggle_remove($user->id, $post_id);
        $ajaxRes['status'] = "SUCCESS";
        $ajaxRes['data'] = $remove;
      }
      else 
      {
        $ajaxRes['status'] = "FAIL";
        $ajaxRes['data'] = "Unexpected situation, please contact developer about this error";
      }
    }
    echo json_encode($ajaxRes);
  }

}