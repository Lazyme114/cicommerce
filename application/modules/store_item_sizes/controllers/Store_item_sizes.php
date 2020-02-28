<?php
class Store_item_sizes extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_store_item_size');
	}

	public function update($item_id)
	{
		if(!is_numeric($item_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$submit = $this->input->post("submit", TRUE);
		$size = trim($this->input->post("size", TRUE));

		if($submit == "submit") {
			if($size != "") {
				$data['size'] = $size;
				$data['item_id'] = $item_id;
				$this->_insert($data);
				$this->session->set_flashdata("success", "Item size added successfully!!");
			}
		}
		$data['sizes'] = $this->get_where_custom("item_id", $item_id);
		$data['heading'] = "Update Item sizes";
		$data['item_id'] = $item_id;
		$data['view_file'] = "update";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete($id = NULL, $item_id = NULL)
	{
		if(!is_numeric($id) || !is_numeric($item_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->_delete($id);
		$this->session->set_flashdata("success", "Item size deleted Successfully!!");
		redirect('store_item_sizes/update/'.$item_id);
	}

	public function _delete_for_item($item_id)
	{
		$this->db->where("item_id", $item_id);
		$this->db->delete("store_item_sizes");
		return TRUE;
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_store_item_size->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_item_size->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_item_size->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_store_item_size->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_store_item_size->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_item_size->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_item_size->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_store_item_size->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_store_item_size->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_store_item_size->_custom_query($mysql_query);
		return $query;
	}

}