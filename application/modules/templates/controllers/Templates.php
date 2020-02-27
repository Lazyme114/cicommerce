<?php
class Templates extends MX_Controller 
{

	function __construct() {
		parent::__construct();
	}

	public function test()
	{
		$data = [];
		$this->admin($data);
	}

	public function public_bootstrap($data)
	{
		$this->load->view('public_bootstrap', $data);
	}

	public function public_jqm($data)
	{
		$this->load->view('public_jqm', $data);
	}

	public function admin($data)
	{
		$this->load->view('admin', $data);
	}

}