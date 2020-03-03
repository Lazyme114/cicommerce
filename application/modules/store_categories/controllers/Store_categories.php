<?php
class Store_categories extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_store_categories');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->CI =& $this;
	}

	public function view($update_id)
	{
		if(!is_numeric($update_id)) {
			redirect("site_security/not_allowed");
		}

		$this->load->module('site_security');
		$this->load->module('site_settings');
		$this->load->module('custom_pagination');
		$this->site_security->_make_sure_is_admin();

		$data = $this->fetch_data_from_db($update_id);

		$data['currency_symbol'] = $this->site_settings->_get_currency_symbol();
		$data['item_segments'] = $this->site_settings->_get_item_segments();

		// count the tems that belong to this category
		$use_limit = FALSE;
		$store_items = $this->_get_category_store_items($update_id, $use_limit);
		$total_items = $store_items->num_rows();

		// Fetch the items for this page
		$use_limit = TRUE;
		$store_items = $this->_get_category_store_items($update_id, $use_limit);

		$pagination_data['template'] = "public";
		$pagination_data['target_base_url'] = $this->_get_target_pagination_base_url();
		$pagination_data['total_rows'] = $total_items;
		$pagination_data['offset_segment'] = 4;
		$pagination_data['limit'] = $this->get_limit();
		$pagination_data['offset'] = $this->get_offset();

		$data['my_pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);
		$data['showing_statement'] = $this->custom_pagination->_get_showing_statement($pagination_data);
		$data['store_items'] = $store_items;
		$data['update_id'] =  $update_id;
		$data['view_module'] = "store_categories";
		$data['view_file'] = "view";
		$this->load->module("templates");
		$this->templates->public($data);
	}

	public function get_limit()
	{
		$limit = 16;
		return $limit;
	}

	public function get_offset()
	{
		$offset = $this->uri->segment(4);
		if(!is_numeric($offset)) {
			$offset = 0;
		}
		return $offset;
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
				$this->session->set_flashdata('success', 'Category successfully updated!!');
				redirect('store_categories/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['categories'] = $this->_get_dropdown_options($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Category";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function fetch_data_from_post()
	{
		$data['category_title'] = $this->input->post("category_title", TRUE);
		$data['parent_id'] = $this->input->post("parent_id", TRUE);
		return $data;
	}

	public function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}

	public function _validate_data()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('category_title', 'Category Title', 'trim|required|callback_category_check');
	}

	public function _get_dropdown_options($update_id = NULL)
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

	public function _get_all_sub_cats_for_dropdown()
	{
		$query = $this->db->select(["id", "category_title", "parent_id"])->where("parent_id !=", "0")
		->order_by("parent_id, category_title")
		->get("store_categories");
		$sub_categories = [];
		foreach($query->result() as $row) {
			$parent_cat_title = $this->_get_category_title($row->parent_id);
			$sub_categories[$row->id] = $parent_cat_title. " > " .$row->category_title;
		}

		return $sub_categories;
	}

	public function _draw_top_nav()
	{
		$this->load->module("site_settings");
		$item_segments = $this->site_settings->_get_items_segments();
		$data['target_url_start'] = base_url().$item_segments;
		$data['parent_categories'] = $this->db->select(["id", "category_title", "category_url"])
		->where("parent_id", "0")
		->order_by("priority")
		->get("store_categories");
		$this->load->view("top_nav", $data);
	}

	public function _get_sub_cats_for_parent_category($parent_id)
	{
		$sub_categories = $this->db->select(["id", "category_title", "category_url"])
		->where("parent_id", $parent_id)
		->order_by("priority")
		->get("store_categories");

		return $sub_categories;
	}

	public function _get_category_id_from_category_url($category_url)
	{

		$query = $this->get_where_custom("category_url", $category_url);
		if($query->num_rows() > 0) {
			$category_id = $query->row()->id;
			if(!isset($category_id)) {
				$category_id = 0;
			}
			return $category_id;	
		} else {
			return 0;
		}
	}

	public function _get_category_store_items($update_id, $use_limit = FALSE)
	{
		$this->db->select(["store_items.item_url", "store_items.item_title", "store_items.item_price", "store_items.was_price", "store_items.small_pic"]);
		$this->db->from("store_cat_assigns");
		$this->db->join("store_items", "store_cat_assigns.item_id=store_items.id");
		$this->db->where(["store_cat_assigns.category_id" => $update_id, "store_items.status" => 1]);

		if($use_limit == TRUE) {
			$limit = $this->get_limit();
			$offset = $this->get_offset();
			$this->db->limit($limit, $offset);
		}

		return $this->db->get();
	}

	public function _get_target_pagination_base_url()
	{
		$first_bit = $this->uri->segment(1);
		$second_bit = $this->uri->segment(2);
		$third_bit = $this->uri->segment(3);

		$target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit;
		return $target_base_url;
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