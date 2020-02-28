<?php
class Store_items extends MX_Controller 
{

	public function __construct() {
		$this->load->model('mdl_store_items');
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	public function view($update_id)
	{
		if(!is_numeric($update_id)) {
			redirect("site_security/not_allowed");
		}

		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] =  $update_id;
		$data['view_file'] = "view";
		$this->load->module("templates");
		$this->templates->public($data);
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['store_items'] = $this->get('item_title');
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
			$this->validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['item_url'] = url_title($data['item_title'], "dash", TRUE);
				$data['created_at'] = date("Y-m-d H:i:s");
				$update_id = $this->_insert($data);
				$this->session->set_flashdata('success', 'Item successfully added!!');
				redirect('store_items/update/'.$update_id,'refresh');
			}
		}
		$data['heading'] = "Add Item";
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
			$this->validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['item_url'] = url_title($data['item_title'], "dash", TRUE);
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'Item successfully updated!!');
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

	public function deleteconf($update_id)
	{
		if(!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['update_id'] = $update_id;
		$data['heading'] = "Update Item";
		$data['view_file'] = "deleteconf";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete($update_id = NULL)
	{
		$this->load->module("store_item_colors");
		$this->load->module("store_item_sizes");
		if(!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->store_item_colors->_delete_for_item($update_id);
		$this->store_item_sizes->_delete_for_item($update_id);
		$this->_delete($update_id);
		$this->delete_image($update_id, "main");
		$this->session->set_flashdata("success", "Item deleted successfully!!");
		redirect("store_items/manage");
	}

	public function upload_image($update_id = NULL)
	{
		if(!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data = $this->fetch_data_from_post();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$config['upload_path'] = './uploads/items/big_pics/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 10240;
			$config['max_width'] = 10240;
			$config['max_height'] = 7680;

			$this->load->library("upload", $config);


			if(! $this->upload->do_upload('image')) {
				$data['errors'] = array('error' => $this->upload->display_errors());
			} else {
				$data = array("upload_data" => $this->upload->data());
				$upload_data = $data['upload_data'];
				$file_name = $upload_data['file_name'];
				$this->_generate_thumbnail($file_name);

				$image_data['big_pic'] = $file_name;
				$image_data['small_pic'] = $file_name;
				$this->_update($update_id, $image_data);
				$this->session->set_flashdata("success", "Image uploaded successfully!!");
			}
			
		}
		$data['heading'] = "Upload Image";
		$data['update_id'] = $update_id;
		$data['view_file'] = "upload_image";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete_image($update_id = NULL, $return_type = NULL)
	{
		$data = $this->fetch_data_from_db($update_id);
		$big_pic = $data['big_pic'];
		$small_pic = $data['small_pic'];

		$big_pic_path = "./uploads/items/big_pics/".$data['big_pic'];
		$small_pic_path = "./uploads/items/small_pics/".$data['small_pic'];

		if(file_exists($big_pic_path)) {
			unlink($big_pic_path);
		}
		if(file_exists($small_pic_path)) {
			unlink($small_pic_path);
		}
		unset($data);

		$data['big_pic'] = $data['small_pic'] = "";

		$this->_update($update_id, $data);
		$this->session->set_flashdata("success", "Image Deleted Successfully!!");

		if($return_type == "main") {
			redirect("store_items/manage");
		}

		redirect("store_items/update/".$update_id);
	}

	private function _generate_thumbnail($file_name)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/items/big_pics/'.$file_name;
		$config['new_image'] = './uploads/items/small_pics/'.$file_name;
		// $config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 200;
		$config['height'] = 200;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}

	private function validate_data()
	{
		$this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[200]|callback_item_check');
		$this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
		$this->form_validation->set_rules('was_price', 'Was Price', 'numeric');
		$this->form_validation->set_rules('item_description', 'Item Description', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
	}


	private function fetch_data_from_post()
	{
		$data["item_title"] = $this->input->post("item_title", TRUE);
		$data["item_price"] = $this->input->post("item_price", TRUE);
		$data["was_price"] = $this->input->post("was_price", TRUE);
		$data["item_description"] = $this->input->post("item_description", TRUE);
		$data["status"] = $this->input->post("status", TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}

	public function item_check($str)
	{
		$item_url = url_title($str, "dash", TRUE);
		$this->db->select("item_title, item_url, id");
		$this->db->where(["item_url" => $item_url, "item_title" => $str]);

		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)) {
			$this->db->where("id !=", $update_id);
		}
		$query = $this->db->get("store_items");
		$num_rows = $query->num_rows();
		if($num_rows > 0) {
			$this->form_validation->set_message('item_check', "The item title:- <b>{$str}</b> is not available.");
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
		return $this->db->insert_id();
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