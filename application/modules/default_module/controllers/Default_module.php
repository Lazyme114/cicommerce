<?php
class Default_module extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{

		$first_bit = trim($this->uri->segment(1));
		$this->load->module("webpages");
		$query = $this->webpages->get_where_custom("page_url", $first_bit);
		$num_rows = $query->num_rows();

		if($num_rows > 0) {
			$row = $query->row();
			$data['page_title'] = $row->page_title;
			$data['page_url'] = $row->page_url;
			$data['page_keywords'] = $row->page_keywords;
			$data['page_content'] = $row->page_content;
			$data['page_descriptions'] = $row->page_descriptions;
		} else {
			$this->load->module("site_settings");
			$data['page_content'] = $this->site_settings->_get_page_not_found_message();
		}
		$this->load->module("templates");
		$this->templates->public($data);
	}
	
}