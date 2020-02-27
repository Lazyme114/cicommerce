<?php
class Store_items extends MX_Controller 
{

	public function __construct() {
		$this->load->model('mdl_store_items');
		parent::__construct();
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['view_module'] = "store_items";
		$data['view_file'] = "manage";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function create()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		$data = $this->fetch_data_from_post();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{

			$this->load->library('form_validation');
			$this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[200]');
			$this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
			$this->form_validation->set_rules('was_price', 'Was Price', 'numeric');
			$this->form_validation->set_rules('item_description', 'Item Description', 'required');

			if ($this->form_validation->run() == TRUE) {
				echo "well done"; die;
			}
		}


		$data['view_module'] = "store_items";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}


	private function fetch_data_from_post()
	{
		$data["item_title"] = $this->input->post("item_title", TRUE);
		$data["item_price"] = $this->input->post("item_price", TRUE);
		$data["was_price"] = $this->input->post("was_price", TRUE);
		$data["item_description"] = $this->input->post("item_description", TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row();
	}

	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_store_items->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_items->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_store_items->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_store_items->_insert($data);
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_items->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_items->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_store_items->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_store_items->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_store_items->_custom_query($mysql_query);
		return $query;
	}

}