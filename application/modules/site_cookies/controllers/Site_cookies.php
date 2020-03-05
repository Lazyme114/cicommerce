<?php
class Site_cookies extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function test()
	{
		echo anchor('Site_cookies/test_set', 'Set The Cookie');

		$user_id = $this->_attempt_get_id();
		echo "<hr>";
		if(is_numeric($user_id)) {
			echo "<h1>Your are user $user_id </h1>";
		}
		echo "<hr>";

		echo anchor('Site_cookies/test_destroy', 'Destroy The Cookie');
	}

	public function test_set()
	{
		$user_id = 88;
		$this->_set_cookie($user_id);
		echo "This cookie has Been set. <br>";

		echo anchor('Site_cookies/test', 'Get The Cookie');
		echo "<hr>";

		echo anchor('Site_cookies/test_destroy', 'Destroy The Cookie');
	}

	public function test_destroy()
	{
		// $user_id = 88;
		$this->_destroy_cookie();
		echo "This cookie has Been set. <br>";

		echo anchor('Site_cookies/test', 'Attempt to get The Cookie');
		echo "<hr>";

		echo anchor('Site_cookies/test_set', 'Set The Cookie');
	}

	public function _set_cookie($user_id)
	{
		$this->load->module("site_settings");
		$this->load->module("site_security");

		$now_time = time();
		$one_day = 86400;
		$two_weeks = $one_day * 14;
		$two_weeks_ahead = $now_time + $two_weeks;

		$data['cookie_code'] = $this->site_security->generate_random_string(128);
		$data['user_id'] = $user_id;
		$data['expiry_date'] = $two_weeks_ahead;

		$this->_insert($data);

		$cookie_name = $this->site_settings->_get_cookie_name();
		setcookie($cookie_name, $data['cookie_code'], $data['expiry_date']);
		$this->_auto_delete_old();
	}

	public function _attempt_get_id()
	{
		$this->load->module("site_settings");
		$cookie_name = $this->site_settings->_get_cookie_name();

		if(isset($_COOKIE[$cookie_name])) {
			$cookie_code = $_COOKIE[$cookie_name];
			$query = $this->get_where_custom("cookie_code", $cookie_code);
			if($query->num_rows() < 1) {
				$user_id = "";
			}
			$user_id = $query->row()->user_id;
		} else {
			$user_id = "";
		}
		return $user_id;
	}

	public function _destroy_cookie()
	{
		$this->load->module("site_settings");
		$cookie_name = $this->site_settings->_get_cookie_name();

		if(isset($_COOKIE[$cookie_name])) {
			$cookie_code = $_COOKIE[$cookie_name];
			$query = $this->get_where_custom("cookie_code", $cookie_code);
			if($query->num_rows() > 0) {
				$cookie_id = $query->row()->id;
				$this->_delete($cookie_id);
			}
		}
		setcookie($cookie_name, '', time() - 3600);
	}

	public function _auto_delete_old()
	{
		$now_time = time();
		$query = $this->get_where_custom("expiry_date <", $now_time);
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$this->_delete($row->id);
			}
		}
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$this->load->model('mdl_site_cookies');
		$query = $this->mdl_site_cookies->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_site_cookies');
		$query = $this->mdl_site_cookies->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_site_cookies');
		$query = $this->mdl_site_cookies->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$this->load->model('mdl_site_cookies');
		$query = $this->mdl_site_cookies->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->load->model('mdl_site_cookies');
		$this->mdl_site_cookies->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_site_cookies');
		$this->mdl_site_cookies->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_site_cookies');
		$this->mdl_site_cookies->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$this->load->model('mdl_site_cookies');
		$count = $this->mdl_site_cookies->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$this->load->model('mdl_site_cookies');
		$max_id = $this->mdl_site_cookies->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$this->load->model('mdl_site_cookies');
		$query = $this->mdl_site_cookies->_custom_query($mysql_query);
		return $query;
	}

}