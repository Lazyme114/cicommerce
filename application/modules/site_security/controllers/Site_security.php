<?php
class Site_security extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function _get_user_id()
	{
		$this->load->module("site_cookies");
		$user_id = $this->session->userdata('user_id');
		if(!is_numeric($user_id)) {
			$user_id = $this->site_cookies->_attempt_get_id();
		}

		return $user_id;
	}

	public function _make_sure_logged_in()
	{
		$user_id = $this->_get_user_id();
		if(!is_numeric($user_id)) {
			$this->session->set_userdata('user_id', $user_id);
			$redirect('members/login','refresh');
		}
	}

	public function generate_random_string($length)
	{
		$characters = '23456789abcdefghjkmnqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
		$random_string = "";
		for($i = 0; $i < $length; $i++) {
			$random_string .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $random_string;
	}


	public function _hash_string($str)
	{
		$hashed_string = password_hash($str, PASSWORD_DEFAULT, ['cost' => 11]);
		return $hashed_string;
	}
	public function _verify_hash($plain_text, $hashed_string)
	{
		$result = password_verify($plain_text, $hashed_string);
		return $result;
	}

	public function _make_sure_is_admin()
	{
		$is_admin = TRUE;
		
		if($is_admin != TRUE) {
			redirect('site_security/not_allowed');
		}	
	}

	public function not_allowed()
	{
		echo "You are not allowed to be here";
	}
}