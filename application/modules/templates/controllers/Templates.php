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

}