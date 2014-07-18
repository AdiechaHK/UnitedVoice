<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presidental extends CI_Controller {

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
    echo "Unexpected url formation";
  }

  public function add_news() {
    $this->load->model('presidential_news_feed');
    $this->presidential_news_feed->insert_entry($_POST);

    // echo var_dump($_POST);
    redirect('admin/presidental');
  }

  public function add_image($news_id) {
    $input = array('news_id'=> $news_id);
    $name = "presidental_news_" . $news_id . "_" . time();
    // $condition = array('id'=> $id);

    $config = array(
        'upload_path'=> "./client_data/images/",
        'allowed_types'=> "gif|jpg|png",
        'file_name'=> $name,
      );

    $this->load->library('upload', $config);
    
    if($this->upload->do_upload('nimage')) {
      // echo "Successfull";
      $res_data = $this->upload->data();
      $img_url = base_url($config['upload_path'].$res_data['file_name']);
      $input['image'] = $img_url;
      $this->load->model('pnews_images');
      $this->pnews_images->insert_entry($input);
      echo "DONE SUCCESSFULLY";
    } else {
      $error = array('error' => $this->upload->display_errors());
      echo var_dump($error);
    }
    redirect('admin/presidental');
  }
}

