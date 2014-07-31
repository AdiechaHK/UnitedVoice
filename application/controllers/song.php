<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Song extends MY_Controller {
	function __construct() {
		parent::__construct();

		$this->_user = $this->session->userdata('user');
	}

	function index() {
		$data['user'] = $this->session->userdata('user');
		$query = $this->db->get('songs');
		$data['rows'] = $query->result_array();
		render_page($this, 'admin_songs', $data, array('dataTable'), true);
	}

	function edit($id = null) {
		$data['user'] = $this->session->userdata('user');
		$query = $this->db->get('user_post');
		$data['rows'] = $query->result_array();
		render_page($this, 'admin_song_edit', $data, array(), true);
	}

	function do_upload() {
		$config['upload_path']   = './php_uploads/';
		$config['allowed_types'] = 'mp3';
		$config['max_size']      = '10240';
		$config['encrypt_name']  = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());

			redirect('song/edit');
		}
		else {
			$file = $this->upload->data();

			$data = array(
				'user_id'     => $this->_user->id,
				'name'        => $file['file_name'],
				'path'        => $file['file_path'],
				'actual_name' => $file['client_name'],
			);

			$this->db->insert('songs', $data);
			redirect('song');
		}
	}
}