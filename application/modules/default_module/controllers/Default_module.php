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
			$data['webpage'] = $query->row();
			$this->load->module("templates");
			$this->templates->public($data);
		}
	}
	
}