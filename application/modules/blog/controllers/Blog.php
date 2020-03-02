<?php
class Blog extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_blog');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->CI =& $this;
	}

	public function manage()
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['blog'] = $this->get('date_published desc');
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
				$data['blog_url'] = url_title($data['blog_title'], "dash", TRUE);
				$data['created_at'] = date("Y-m-d H:i:s");
				$update_id = $this->_insert($data);
				$this->session->set_flashdata('success', 'Blog Entry successfully created!!');
				redirect('blog/update/'.$update_id,'refresh');
			}
		}
		$data['heading'] = "Create New Blog Entry";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function update($update_id = NULL)
	{
		$this->load->module('site_security');
		$this->load->library('session');
		$this->site_security->_make_sure_is_admin();
		$data = $this->fetch_data_from_post();
		$submit = $this->input->post("submit", TRUE);
		if ($submit == "submit")
		{
			$this->_validate_data();
			if ($this->form_validation->run() == TRUE) {
				$data['blog_url'] = url_title($data['blog_title'], "dash", TRUE);
				$this->_update($update_id, $data);
				$this->session->set_flashdata('success', 'Blog Entry successfully updated!!');
				redirect('blog/update/'.$update_id,'refresh');
			}
		}
		$data = $this->fetch_data_from_db($update_id);
		$data['update_id'] = $update_id;
		$data['heading'] = "Update Blog Entry";
		$data['view_file'] = "create";
		$this->load->module('templates');
		$this->templates->admin($data);
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
			$config['upload_path'] = './uploads/blogs/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 10240;
			$config['max_width'] = 10240;
			$config['max_height'] = 7680;
			$config['file_name'] = $this->site_security->generate_random_string(16);

			$this->load->library("upload", $config);


			if(! $this->upload->do_upload('image')) {
				$data['errors'] = array('error' => $this->upload->display_errors());
			} else {
				$data = array("upload_data" => $this->upload->data());
				$upload_data = $data['upload_data'];

				$raw_name = $upload_data['raw_name'];
				$file_ext = $upload_data['file_ext'];

				$thumbnail_name = $raw_name."_thumb".$file_ext;

				$file_name = $upload_data['file_name'];
				$this->_generate_thumbnail($file_name, $thumbnail_name);

				$image_data['picture'] = $file_name;
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

	public function deleteconf($update_id)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$data['update_id'] = $update_id;
		$data['heading'] = "Delete Blog Entry";
		$data['view_file'] = "deleteconf";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete($update_id = NULL)
	{
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->_delete($update_id);
		$this->session->set_flashdata("success", "Blog Entry deleted successfully!!");
		redirect("blog/manage");
	}

	public function delete_image($update_id = NULL, $return_type = NULL)
	{
		$data = $this->fetch_data_from_db($update_id);
		$picture = $data['picture'];
		$thumbnail = str_replace(".", "_thumb.", $picture);

		$picture_path = "./uploads/blogs/".$data['picture'];
		$thumbnail_path = "./uploads/blogs/".$thumbnail;

		if(file_exists($picture_path)) {
			unlink($picture_path);
		}

		if(file_exists($thumbnail_path)) {
			unlink($thumbnail_path);
		}

		unset($data);

		$data['picture'] = "";

		$this->_update($update_id, $data);
		$this->session->set_flashdata("success", "Image Deleted Successfully!!");

		if($return_type == "main") {
			redirect("blog/manage");
		}

		redirect("blog/update/".$update_id);
	}


	private function _validate_data()
	{
		$this->form_validation->set_rules('blog_title', 'Blog Entry Title', 'required|max_length[200]|callback_blog_check');
		$this->form_validation->set_rules('blog_content', 'Blog Entry Content', 'required');
		$this->form_validation->set_rules('date_published', 'Date Published', 'required');
	}

	private function fetch_data_from_post()
	{
		$data["date_published"] = $this->input->post("date_published", TRUE);
		$data["author"] = $this->input->post("author", TRUE);
		$data["blog_title"] = $this->input->post("blog_title", TRUE);
		$data["blog_keywords"] = $this->input->post("blog_keywords", TRUE);
		$data["blog_descriptions"] = $this->input->post("blog_descriptions", TRUE);
		$data["blog_content"] = $this->input->post("blog_content", TRUE);
		return $data;
	}

	private function fetch_data_from_db($update_id = NULL)
	{
		$query = $this->get_where($update_id);
		return $query->row_array();
	}


	private function _generate_thumbnail($file_name, $thumbnail_name)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/blogs/'.$file_name;
		$config['new_image'] = './uploads/blogs/'.$thumbnail_name;
		// $config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 200;
		$config['height'] = 200;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}

	public function _draw_feed_hp()
	{
		$this->load->helper('text');
		$data['latest_blogs'] = $this->get_with_limit(3, 0, "date_published desc");
		$this->load->view("feed_hp", $data);
	}

	public function blog_check($str)
	{
		$blog_url = url_title($str, "dash", TRUE);
		$this->db->select("blog_title, blog_url, id");
		$this->db->where(["blog_url" => $blog_url, "blog_title" => $str]);

		$update_id = $this->uri->segment(3);
		if(is_numeric($update_id)) {
			$this->db->where("id !=", $update_id);
		}
		$query = $this->db->get("blogs");
		$num_rows = $query->num_rows();
		if($num_rows > 0) {
			$this->form_validation->set_message('blog_check', "The blog title:- <b>{$str}</b> is not available.");
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
		$query = $this->mdl_blog->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_blog->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_blog->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_blog->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_blog->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_blog->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_blog->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_blog->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_blog->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_blog->_custom_query($mysql_query);
		return $query;
	}

}