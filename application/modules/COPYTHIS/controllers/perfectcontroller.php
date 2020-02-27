<?php
class Perfectcontroller extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->load->model('mdl_perfectcontroller');
		$this->mdl_perfectcontroller->_insert($data);
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_perfectcontroller');
		$this->mdl_perfectcontroller->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->load->model('mdl_perfectcontroller');
		$this->mdl_perfectcontroller->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$this->load->model('mdl_perfectcontroller');
		$count = $this->mdl_perfectcontroller->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$this->load->model('mdl_perfectcontroller');
		$max_id = $this->mdl_perfectcontroller->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->_custom_query($mysql_query);
		return $query;
	}

}