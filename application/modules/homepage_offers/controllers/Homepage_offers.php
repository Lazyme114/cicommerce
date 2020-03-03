<?php
class Homepage_offers extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('mdl_homepage_offers');
	}

	public function update($block_id)
	{
		if(!is_numeric($block_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$submit = $this->input->post("submit", TRUE);
		$item_id = trim($this->input->post("item_id", TRUE));

		if($submit == "submit") {
			if($item_id != "") {
				$data['item_id'] = $item_id;
				$data['block_id'] = $block_id;
				$this->_insert($data);
				$this->session->set_flashdata("success", "Item Offer added successfully!!");
			}
		}
		$data['item_ids'] = $this->get_where_custom("block_id", $block_id);
		$data['heading'] = "Update Homepage Offers";
		$data['block_id'] = $block_id;
		$data['view_file'] = "update";
		$this->load->module('templates');
		$this->templates->admin($data);
	}

	public function delete($id = NULL, $block_id = NULL)
	{
		if(!is_numeric($id) || !is_numeric($block_id)) {
			redirect('site_security/not_allowed');
		}
		$this->load->module('site_security');
		$this->site_security->_make_sure_is_admin();

		$this->_delete($id);
		$this->session->set_flashdata("success", "Item Offer deleted Successfully!!");
		redirect('homepage_offers/update/'.$block_id);
	}

	public function _delete_for_item($block_id)
	{
		$this->db->where("block_id", $block_id);
		$this->db->delete("homepage_offers");
		return TRUE;
	}

	public function _draw_homepage_offers($block_id, $theme)
	{
		$this->load->module('site_settings');

		$this->db->select(["store_items.id", "store_items.item_title", "store_items.item_url", "store_items.item_price", "store_items.was_price", "store_items.item_description", "store_items.small_pic", "homepage_blocks.block_title"]);
		$this->db->from("homepage_offers");
		$this->db->join("homepage_blocks", "homepage_offers.block_id = homepage_blocks.id", "inner");
		$this->db->join("store_items", "homepage_offers.item_id = store_items.id", "inner");
		$this->db->where("homepage_offers.block_id", $block_id);
		$query = $this->db->get();


		$data['currency_symbol'] = $this->site_settings->_get_currency_symbol();
		$data['item_segments'] = $this->site_settings->_get_item_segments();
		$data['block_id'] = $block_id;
		$data['theme'] = $theme;
		if($query->num_rows() > 0) {
			$data['query'] = $query;
			$this->load->view('offers', $data);
		}
	}


	// ======================================================
	// ================== database querie ===================
	// ======================================================

	public function get($order_by)
	{
		$query = $this->mdl_homepage_offers->get($order_by);
		return $query;
	}

	public function get_with_limit($limit, $offset, $order_by) 
	{
		if ((!is_numeric($limit)) || (!is_numeric($offset))) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_homepage_offers->get_with_limit($limit, $offset, $order_by);
		return $query;
	}

	public function get_where($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$query = $this->mdl_homepage_offers->get_where($id);
		return $query;
	}

	public function get_where_custom($col, $value) 
	{
		$query = $this->mdl_homepage_offers->get_where_custom($col, $value);
		return $query;
	}

	public function _insert($data)
	{
		$this->mdl_homepage_offers->_insert($data);
		return $this->db->insert_id();
	}

	public function _update($id, $data)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_homepage_offers->_update($id, $data);
	}

	public function _delete($id)
	{
		if (!is_numeric($id)) {
			die('Non-numeric variable!');
		}

		$this->mdl_homepage_offers->_delete($id);
	}

	public function count_where($column, $value) 
	{
		$count = $this->mdl_homepage_offers->count_where($column, $value);
		return $count;
	}

	public function get_max() 
	{
		$max_id = $this->mdl_homepage_offers->get_max();
		return $max_id;
	}

	public function _custom_query($mysql_query) 
	{
		$query = $this->mdl_homepage_offers->_custom_query($mysql_query);
		return $query;
	}

}