<?php
class Templates extends MX_Controller 
{

	function __construct() {
		parent::__construct();
	}

	public function public($data)
	{
		if(!isset($data['view_module'])) {
			$data['view_module'] = $this->uri->segment(1);
		}
		$this->load->view('public', $data);
	}

	public function public_jqm($data)
	{
		if(!isset($data['view_module'])) {
			$data['view_module'] = $this->uri->segment(1);
		}
		$this->load->view('public_jqm', $data);
	}

	public function admin($data)
	{
		if(!isset($data['view_module'])) {
			$data['view_module'] = $this->uri->segment(1);
		}
		$this->load->view('admin', $data);
	}

	public function _draw_breadcrumbs($data)
	{
		// Note: for this to work, data must contains:
		// template, current_page_title, breadcrumbs_array
		$this->load->view("breadcrumbs_public", $data);
	}

	public function _draw_customer_nav($data)
	{
		$this->load->view("customer_navbar", $data);
	}

}