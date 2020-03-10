<?php
class Enquiries extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function create()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$submit = $this->input->post("submit", TRUE);

		if($submit == "submit") {
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data =$this->fetch_data_from_post();
				$data['created_at'] = date("Y-m-d H:i:s");
				$this->_insert($data);
				$this->session->set_flashdata('success', 'Message sent successfully!!');
				redirect('enquiries/sent','refresh');
			} else {
				$data['errors'] = validation_errors();
			}
		}

		$data['folder_type'] = "create";
		$data['query'] = $this->_fetch_enquiries($data['folder_type']);

		$data['flash'] = $this->session->flashdata('success');

		$data['view_file'] = "view_enquiries";
		$this->load->module('templates');
		$this->templates->admin($data);	
	}

	public function inbox()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['folder_type'] = "inbox";
		$data['query'] = $this->_fetch_enquiries($data['folder_type']);

		$data['flash'] = $this->session->flashdata('success');

		$data['view_file'] = "view_enquiries";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function sent()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['folder_type'] = "sent";
		$data['query'] = $this->_fetch_enquiries($data['folder_type']);

		$data['flash'] = $this->session->flashdata('success');

		$data['view_file'] = "view_enquiries";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function show($id = NULL)
	{
		$this->load->module('store_accounts');
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['folder_type'] = "show";
		$data['query'] = $this->_fetch_enquiries($data['folder_type'], $id)->row();


		$user_id = $data['query']->sent_to;

		if($user_id == 0) {
			$data['mail_type'] = "Inbox";
			$this->_mark_as_opened($id);
			$data['customer_name'] = $this->store_accounts->_get_customer_name($data['query']->sent_by);
		} else {
			$data['mail_type'] = "Sent";
			$data['customer_name'] = $this->store_accounts->_get_customer_name($data['query']->sent_to);
		}


		$data['view_file'] = "view_enquiries";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function fetch_data_from_post()
	{
		$data['sent_to'] = $this->input->post("sent_to", TRUE);
		$data['subject'] = $this->input->post("subject", TRUE);
		$data['message'] = $this->input->post("message", TRUE);
		return $data;
	}

	public function _fetch_enquiries($folder_type, $id = NULL)
	{
		$this->load->module("store_accounts");
		switch ($folder_type) {
			case 'inbox':
			$query = $this->get_where_custom("sent_to", 0);
			break;

			case 'sent':
			$query = $this->get_where_custom("sent_to !=", 0);
			break;

			case 'create':
			$query = $this->store_accounts->get("first_name");
			break;

			case 'show':
			$query = $this->get_where($id);
			break;
			
			default:
			$query = $this->get_where_custom("sent_to", 0);
			break;
		}

		return $query;
	}

	public function _validate_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sent_to', 'User', 'trim|required|numeric');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'required');
	}

	public function _mark_as_opened($id)
	{
		$data['is_open'] = 1;
		$this->_update($id, $data);
		return TRUE;
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$this->load->model('mdl_enquiries');
		$query = $this->mdl_enquiries->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_enquiries');
		$query = $this->mdl_enquiries->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_enquiries');
		$query = $this->mdl_enquiries->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$this->load->model('mdl_enquiries');
		$query = $this->mdl_enquiries->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->load->model('mdl_enquiries');
		$this->mdl_enquiries->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_enquiries');
		$this->mdl_enquiries->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_enquiries');
		$this->mdl_enquiries->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$this->load->model('mdl_enquiries');
		$count = $this->mdl_enquiries->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$this->load->model('mdl_enquiries');
		$max_id = $this->mdl_enquiries->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$this->load->model('mdl_enquiries');
		$query = $this->mdl_enquiries->_custom_query($mysql_query);
		return $query;
	}

}