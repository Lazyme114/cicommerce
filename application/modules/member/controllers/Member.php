<?php
class Member extends MX_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	public function account()
	{
		$this->load->module("site_security");
		$this->site_security->_make_sure_logged_in();
		$data['view_file'] = "account";
		$this->load->module("templates");
		$this->templates->public($data);
	}

	public function register()
	{
		$this->load->module("store_accounts");
		$this->load->module("site_security");
		$data = $this->fetch_data_from_register_post();
		$submit = $this->input->post("submit", TRUE);
		if($submit == "submit") {
			$this->_validate_data();
			if($this->form_validation->run() == TRUE) {
				unset($data['re_password']);
				$data['password'] = $this->site_security->_hash_string($data['password']);
				$data['created_at'] = date("Y-m-d H:i:s");
				$this->store_accounts->_insert($data);
				$this->session->set_flashdata('success', 'Account Successfully created!!');
				redirect('member/login','refresh');
			} else {
				$data['errors'] = validation_errors();
			}
		}

		$data['view_file'] = "register";
		$this->load->module("templates");
		$this->templates->public($data);
	}

	public function login()
	{
		$data = $this->fetch_data_from_login_post();
		$submit = $this->input->post("submit", TRUE);
		if($submit == "submit") {
			$this->_validate_login_data();
			if($this->form_validation->run() == TRUE) {
				// figure out user_id
				$query = $this->_get_login_user_query($data['username']);
				$user_id = $query->row()->id;
				// send them to private section
				$remember_me = $this->input->post("remember", TRUE);

				if($remember_me == "remember-me") {
					$login_type = "longterm";
				} else {
					$login_type = "shortterm";
				}
				$this->_in_you_go($user_id, $login_type);
			} else {
				$data['errors'] = validation_errors();
			}
		}
		$data['view_file'] = "login";
		$this->load->module("templates");
		$this->templates->public($data);
	}

	public function logout()
	{
		unset($_SESSION['user_id']);
		$this->load->module('site_cookies');
		$this->site_cookies->_destroy_cookie();

		redirect(base_url(),'refresh');
	}

	public function fetch_data_from_login_post()
	{
		$data['username'] = $this->input->post("username", TRUE);
		$data['password'] = $this->input->post("password", TRUE);
		return $data;
	}

	public function fetch_data_from_register_post()
	{
		$data['first_name'] = $this->input->post('first_name', TRUE);
		$data['last_name'] = $this->input->post('last_name', TRUE);
		$data['username'] = $this->input->post('username', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		$data['country'] = $this->input->post('country', TRUE);
		$data['town'] = $this->input->post('town', TRUE);
		$data['address1'] = $this->input->post('address_1', TRUE);
		$data['address2'] = $this->input->post('address_2', TRUE);
		$data['telephone'] = $this->input->post('telephone', TRUE);
		$data['postcode'] = $this->input->post('postcode', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['re_password'] = $this->input->post('re_password', TRUE);
		return $data;
	}

	private function _validate_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[200]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[200]');
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[200]|is_unique[store_accounts.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('address_1', 'Address 1', 'required');
		$this->form_validation->set_rules('telephone', 'Phone', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]');
	}

	private function _validate_login_data()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
	}

	public function _get_login_user_query($str)
	{
		$col1 = "username";
		$col2 = "email";
		$value1 = $value2 = $str;
		return $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
	}

	public function _in_you_go($user_id, $login_type)
	{
		$this->load->module("site_cookies");
		if($login_type == "longterm") {
			$this->site_cookies->_set_cookie($user_id);
		} else {
			$this->session->set_userdata("user_id", $user_id);
		}
		redirect('member/account','refresh');
	}

	public function username_check($str)
	{
		$this->load->module("store_accounts");
		$this->load->module("site_security");

		$error_msg = "Invalid username / password.";
		$query = $this->_get_login_user_query($str);

		if($query->num_rows() < 1) {
			$this->form_validation->set_message("username_check", $error_msg);
			return FALSE;
		}

		$password_in_table = $query->row()->password;

		$data = $this->fetch_data_from_login_post();
		$result = $this->site_security->_verify_hash($data['password'], $password_in_table);

		if($result == TRUE) {
			return TRUE;
		} else {
			$this->form_validation->set_message("username_check", $error_msg);
			return FALSE;
		}
	}

}