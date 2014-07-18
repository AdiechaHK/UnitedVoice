<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$user = $this->session->userdata("user");
		$data = array();
		if($user != NULL) {
			$data['user'] = $user;			
		}
		$login_error = $this->session->userdata("login_error");
		if($login_error != NULL) {
			$data['login_error'] = $login_error;
			$this->session->unset_userdata('login_error');
		}
		$this->load->model('user_post');
		$data['posts'] = $this->user_post->get_list_recent_first(($user!=NULL?$user->id:NULL));
    $this->load->model('presidential_news_feed');
    $data['list_of_pnews'] = $this->presidential_news_feed->get_populated_list();
		render_page($this, 'welcome_message', $data);
	}

	public function home() {
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */