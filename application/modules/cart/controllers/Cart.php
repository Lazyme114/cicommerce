<?php
class Cart extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function _draw_add_to_cart($item_id = NULL)
	{
		$this->load->module("store_item_colors");
		$this->load->module("store_item_sizes");
		$data['colors'] = $this->store_item_colors->get_where_custom("item_id", $item_id);
		$data['sizes'] = $this->store_item_sizes->get_where_custom("item_id", $item_id);
		$data['item_id'] = $item_id;
		$this->load->view("add_to_cart", $data);
	}
}