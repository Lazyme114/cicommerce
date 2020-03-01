<?php
class Webpages extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_webpages');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['webpages'] = $this->get('page_url');
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
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['page_url'] = url_title($data['page_title'], "dash", TRUE);
				$data['created_at'] = date("Y-m-d H:i:s");
				$update_id = $this->_insert($data);
				$this->session->set_flashdata('success', 'Page successfully created!!');
				redirect('webpages/update/'.$update_id,'refresh');
			}
		}
		$data['heading'] = "Create New Page";
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
				if($update_id > 2) {
					$data['page_url'] = url_title($data['page_title'], "dash", TRUE);
				}
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'Page successfully updated!!');
				redirect('webpages/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Page";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function deleteconf($update_id)
	{
		if(!is_numeric($update_id) || $update_id < 3) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['update_id'] = $update_id;
		$data['heading'] = "Delete Page";
		$data['view_file'] = "deleteconf";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete($update_id = NULL)
	{
		if(!is_numeric($update_id)  || $update_id < 3) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->_delete($update_id);
		$this->session->set_flashdata("success", "Page deleted successfully!!");
		redirect("webpages/manage");
	}


	private function _validate_data()
	{
		$this->form_validation->set_rules('page_title', 'Page Title', 'required|max_length[200]|callback_page_check');
		$this->form_validation->set_rules('page_content', 'Page Content', 'required');
	}

	private function fetch_data_from_post()
	{
		$data["page_title"] = $this->input->post("page_title", TRUE);
		$data["page_keywords"] = $this->input->post("page_keywords", TRUE);
		$data["page_descriptions"] = $this->input->post("page_descriptions", TRUE);
		$data["page_content"] = $this->input->post("page_content", TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}

	public function page_check($str)
	{
		$page_url = url_title($str, "dash", TRUE);
		$this->db->select("page_title, page_url, id");
		$this->db->where(["page_url" => $page_url, "page_title" => $str]);

		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)) {
			$this->db->where("id !=", $update_id);
		}
		$query = $this->db->get("webpages");
		$num_rows = $query->num_rows();
		if($num_rows > 0) {
			$this->form_validation->set_message('page_check', "The page title:- <b>{$str}</b> is not available.");
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
		$query = $this->mdl_webpages->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_webpages->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_webpages->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_webpages->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_webpages->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_webpages->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_webpages->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_webpages->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_webpages->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_webpages->_custom_query($mysql_query);
		return $query;
	}

}