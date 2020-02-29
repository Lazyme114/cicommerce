<?php
class Site_security extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}


	public function _hash_string($str)
	{
		$hashed_string = password_hash($str, PASSWORD_DEFAULT, ['cost' => 11]);
		return $hashed_string;
	}
	public function _verify_hash($plain_text, $hashed_string)
	{
		$result = password_verify($plain_text, $hashed_string);
		return $result;
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