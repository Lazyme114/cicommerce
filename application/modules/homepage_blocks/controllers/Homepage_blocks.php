<?php
class Homepage_blocks extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_homepage_blocks');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->CI =& $this;
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

		$data['sort_this'] = TRUE;
		$data['homepage_blocks'] = $this->db->order_by('priority')->get("homepage_blocks");
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
				$update_id = $this->_insert($data);
				$this->session->set_flashdata('success', 'homepage offer successfully added!!');
				redirect('homepage_blocks/update/'.$update_id,'refresh');
			}
		}
		$data['heading'] = "Add homepage offer";
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
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'homepage offer successfully updated!!');
				redirect('homepage_blocks/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update homepage offer";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function fetch_data_from_post()
	{
		$data['block_title'] = $this->input->post("block_title", TRUE);
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
		$this->form_validation->set_rules('block_title', 'homepage offer Title', 'trim|required');
	}


	public function _get_block_title($update_id)
	{
		$data = $this->fetch_data_from_db($update_id);
		$block_title = $data['block_title'];
		return $block_title;
	}

	public function _get_target_pagination_base_url()
	{
		$first_bit = $this->uri->segment(1);
		$second_bit = $this->uri->segment(2);
		$third_bit = $this->uri->segment(3);

		$target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit;
		return $target_base_url;
	}

	public function _draw_blocks()
	{
		$data['query'] = $this->get("priority");
		if($data['query']->num_rows() > 0) {
			$this->load->view("blocks", $data);
		}
	}

	public function _draw_sortable_list()
	{
		$data['query'] = $this->get('priority');
		$this->load->view("sortable_list", $data);
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_homepage_blocks->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_homepage_blocks->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_homepage_blocks->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_homepage_blocks->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_homepage_blocks->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_homepage_blocks->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_homepage_blocks->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_homepage_blocks->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_homepage_blocks->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_homepage_blocks->_custom_query($mysql_query);
		return $query;
	}

}