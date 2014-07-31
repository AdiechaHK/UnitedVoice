<?php

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();

		if (!$this->_authentication()) {
			redirect('admin');
		}
	}

	function _authentication() {
		$user = $this->session->userdata("user");
		if($user != NULL)
			return true;
		return false;
	}
}