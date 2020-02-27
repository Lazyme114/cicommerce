<?php
class Site_security extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function _make_sure_is_admin()
	{
		$is_admin = TRUE;
		
		if($is_admin != TRUE) {
			redirect('site_security/not_allowed');
		}	
	}

	public function not_allowed()
	{
		echo "You are not allowed to be here";
	}
}