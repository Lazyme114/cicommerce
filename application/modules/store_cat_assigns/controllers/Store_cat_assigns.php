<?php
class Store_cat_assigns extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_store_cat_assigns');
	}

	public function update($item_id)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		
		$this->load->module('store_categories');
		$submit = $this->input->post("submit", TRUE);
		$category_id = trim($this->input->post("category_id", TRUE));
		if($submit == "submit") {
			if($category_id != "") {
				$data['category_id'] = $category_id;
				$data['item_id'] = $item_id;
				$this->_insert($data);
				$this->session->set_flashdata("success", "Store Category assigned successfully!!");
				redirect("store_cat_assigns/update/".$item_id);
			}
		}

		$data['sub_categories'] = $this->store_categories->_get_all_sub_cats_for_dropdown();
		$data['assigned_categories'] = $this->get_where_custom('item_id', $item_id);
		$data['item_id'] = $item_id;
		$data['heading'] = "Category Assign";
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
		$this->session->set_flashdata("success", "Store item category deleted Successfully!!");
		redirect('store_cat_assigns/update/'.$item_id);
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_store_cat_assigns->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_cat_assigns->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_cat_assigns->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_store_cat_assigns->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_store_cat_assigns->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_cat_assigns->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_cat_assigns->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_store_cat_assigns->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_store_cat_assigns->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_store_cat_assigns->_custom_query($mysql_query);
		return $query;
	}

}