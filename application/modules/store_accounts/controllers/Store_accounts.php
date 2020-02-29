<?php
class Store_accounts extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_store_accounts');
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['store_accounts'] = $this->get('first_name');
		$data['view_file'] = "manage";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function create()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$submit = $this->input->post("submit", TRUE);
		$data = $this->fetch_data_from_post();
		if ($submit == "submit")
		{
			$this->load->library("form_validation");
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['created_at'] = date("Y-m-d H:i:s");
				$update_id = $this->_insert($data);
				$this->session->set_flashdata("success", "The account was successfully added!!");
				redirect('store_accounts/update/'.$update_id,'refresh');
			}
		}

		$data['heading'] = "Add New Account";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function update($update_id = NULL)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data = $this->fetch_data_from_post();
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'The account details was successfully updated!!');
				redirect('store_items/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Item";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function update_password($update_id = NULL)
	{
		if(!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == TRUE) {
				$data['password'] = $this->site_security->_hash_string($this->input->post("password", TRUE));
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'The account password was successfully updated!!');
				redirect('store_accounts/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Account Password";
		$data['view_file'] = "update_password";
		$this->load->module('templates');
		$this->templates->admin($data);
	}


	private function _validate_data()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	}

	private function fetch_data_from_post()
	{
		$data['first_name'] = $this->input->post('first_name', TRUE);
		$data['last_name'] = $this->input->post('last_name', TRUE);
		$data['company'] = $this->input->post('company', TRUE);
		$data['address1'] = $this->input->post('address1', TRUE);
		$data['address2'] = $this->input->post('address2', TRUE);
		$data['town'] = $this->input->post('town', TRUE);
		$data['country'] = $this->input->post('country', TRUE);
		$data['postcode'] = $this->input->post('postcode', TRUE);
		$data['telephone'] = $this->input->post('telephone', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}



	// for auto generate data
	public function autogen()
	{
		redirect('site_security/not_allowed','refresh');

		$query = $this->db->query("SHOW COLUMNS FROM Store_accounts");
		foreach($query->result() as $row) {
			$column_name = $row->Field;
			echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
		}

		foreach($query->result() as $row) {
			$column_name = $row->Field;
			
			$var = '<div class="control-group">
			<label class="control-label" for="'.$column_name.'">'.ucfirst($column_name).' </label>
			<div class="controls">
			<input type="text" class="span5" name="'.$column_name.'" id="'.$column_name.'" value="<?php echo $'.$column_name.'; ?>">
			</div>
			</div>';

			echo htmlentities($var);
			echo "<br>";
		}
	}

	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_store_accounts->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_accounts->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_store_accounts->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_store_accounts->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_accounts->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_accounts->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_store_accounts->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_store_accounts->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_store_accounts->_custom_query($mysql_query);
		return $query;
	}

}