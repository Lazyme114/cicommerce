<?php
class Music extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function instruments()
	{
		$category_url = $this->uri->segment(3);
		$this->load->module("store_categories");
		$category_id = $this->store_categories->_get_category_id_from_category_url($category_url);
		$this->store_categories->view($category_id);
	}


}