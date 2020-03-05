<?php
class Member extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function register()
	{
		$this->load->module("store_accounts");
		$this->load->module("site_security");
		$data = $this->fetch_data_from_post();
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
		$data['username'] = "";
		$data['view_file'] = "login";
		$this->load->module("templates");
		$this->templates->public($data);
	}
	

	public function fetch_data_from_post()
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

}