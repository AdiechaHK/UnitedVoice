<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
  public function index()
  {
    // echo "Came here";
    // $data = array();
    // render_page($this, 'admin_home', $data);
    $user = $this->session->userdata("user");
    $data = array();
    if($user != NULL) {
      //$data['user'] = $user;
      redirect('admin/home');
    } else {
      $login_error = $this->session->userdata("login_error");
      $this->session->unset_userdata('login_error');        
      if($login_error != NULL) {
        $data['login_error'] = $login_error;
      }
      render_page($this, 'admin_login', $data);
    }
  }

  public function home() {
    $user = $this->session->userdata("user");
    $data = array();
    if($user != NULL) {
      $data['user'] = $user;
      render_page($this, 'admin_home', $data, array(), true);
    } else {
      $login_error = $this->session->userdata("login_error");
      $this->session->unset_userdata('login_error');        
      if($login_error != NULL) {
        $data['login_error'] = $login_error;
      }
      render_page($this, 'admin_login', $data);
    }
  }

  public function presidental() {
    $user = $this->session->userdata("user");
    $data = array();
    if($user != NULL) {
      $data['user'] = $user;
      $this->load->model('presidential_news_feed');
      $data['list_of_news'] = $this->presidential_news_feed->get_populated_list();
      // echo var_dump($data);
      render_page($this, 'admin_presidental', $data, array(), true);
    } else {
      $login_error = $this->session->userdata("login_error");
      $this->session->unset_userdata('login_error');        
      if($login_error != NULL) {
        $data['login_error'] = $login_error;
      }
      render_page($this, 'admin_login', $data);
    }
  }

  public function sector() {
    $user = $this->session->userdata("user");
    $data = array();
    if($user != NULL) {
      $data['user'] = $user;      
      render_page($this, 'admin_sector', $data, array(), true);
    } else {
      $login_error = $this->session->userdata("login_error");
      $this->session->unset_userdata('login_error');        
      if($login_error != NULL) {
        $data['login_error'] = $login_error;
      }
      render_page($this, 'admin_login', $data);
    }
  }

  public function songs() {
    $user = $this->session->userdata("user");
    $data = array();
    if($user != NULL) {
      $data['user'] = $user;      
      render_page($this, 'admin_songs', $data, array(), true);
    } else {
      $login_error = $this->session->userdata("login_error");
      $this->session->unset_userdata('login_error');        
      if($login_error != NULL) {
        $data['login_error'] = $login_error;
      }
      render_page($this, 'admin_login', $data);
    }
  }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */