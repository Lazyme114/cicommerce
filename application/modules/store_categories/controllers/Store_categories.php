<?php
class Store_categories extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_store_categories');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$parent_cat_id = $this->uri->segment(3);
		if($parent_cat_id == "") {
			$parent_cat_id = 0;
		}
		$data['sort_this'] = TRUE;
		$data['parent_cat_id'] = $parent_cat_id;
		$data['store_categories'] = $this->db->where("parent_id", $parent_cat_id)->order_by('priority')->get("store_categories");
		$data['view_file'] = "manage";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function sort()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$number = $this->input->post('number', TRUE);
		for($i = 1; $i <= $number; $i++) {
			$update_id = $_POST['order'.$i];
			$data['priority'] = $i;
			$this->_update($update_id,$data);

		}
	}

	public function create()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		$data = $this->fetch_data_from_post();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['category_url'] = url_title($data['category_title'], "dash", TRUE);
				$data['created_at'] = date("Y-m-d H:i:s");
				$update_id = $this->_insert($data);
				$this->session->set_flashdata('success', 'Category successfully added!!');
				redirect('store_categories/update/'.$update_id,'refresh');
			}
		}
		$data['categories'] = $this->_get_dropdown_options();
		$data['heading'] = "Add Category";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function update($update_id = NULL)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();
		$data = $this->fetch_data_from_post();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['category_url'] = url_title($data['category_title'], "dash", TRUE);
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'Item successfully updated!!');
				redirect('store_categories/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['categories'] = $this->_get_dropdown_options($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Item";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	private function fetch_data_from_post()
	{
		$data['category_title'] = $this->input->post("category_title", TRUE);
		$data['parent_id'] = $this->input->post("parent_id", TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}

	private function _validate_data()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('category_title', 'Category Title', 'trim|required|callback_category_check');
	}

	private function _get_dropdown_options($update_id = NULL)
	{
		if(!is_numeric($update_id)) {
			$update_id = 0;
		}
		$query = $this->db->select(["category_title", "id"])
		->where(["parent_id" => 0, "id !=" => $update_id ])
		->get("store_categories");
		return $query;
	}

	public function _get_category_title($update_id)
	{
		$data = $this->fetch_data_from_db($update_id);
		$category_title = $data['category_title'];
		return $category_title;
	}

	public function _count_sub_categories($update_id)
	{
		$query = $this->get_where_custom("parent_id", $update_id);
		return $query->num_rows();
	}

	public function _draw_sortable_list($parent_cat_id)
	{
		$data['query'] = $this->get_where_custom('parent_id', $parent_cat_id);
		$this->load->view("sortable_list", $data);
	}

	public function category_check($str)
	{
		$category_url = url_title($str, "dash", TRUE);
		$this->db->select("category_title, category_url, id");
		$this->db->where(["category_url" => $category_url, "category_title" => $str]);

		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)) {
			$this->db->where("id !=", $update_id);
		}
		$query = $this->db->get("store_categories");
		$num_rows = $query->num_rows();
		if($num_rows > 0) {
			$this->form_validation->set_message('category_check', "The category title:- <b>{$str}</b> is not available.");
			return FALSE;
		} else {
			return TRUE;
		}
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_store_categories->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_categories->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_store_categories->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_store_categories->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_store_categories->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_categories->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_store_categories->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_store_categories->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_store_categories->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_store_categories->_custom_query($mysql_query);
		return $query;
	}

}