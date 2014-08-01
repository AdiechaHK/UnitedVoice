<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
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
	    $query = $this->db->get('songs');
	    $data['songs'] = $query->result_array();
		render_page($this, 'welcome_message', $data, array('mediaElement', 'dataTable'));
	}

	public function home() {
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */