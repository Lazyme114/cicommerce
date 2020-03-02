<?php
class Site_settings extends MX_Controller 
{

	public function __construct() {
		parent::__construct();
	}

	public function _get_currency_symbol()
	{
		$symbol = "&pound;";
		return $symbol;
	}

	public function _get_item_segments()
	{
		// returng the segments for the store-item pages (product pages)
		$segments = "musical/instrument/";
		return $segments;
	}

	public function _get_items_segments()
	{
		// return the segments for the category page
		$segments = "music/instruments/";
		return $segments;
	}

	public function _get_page_not_found_message()
	{
		$msg = "<h1 class='title'>Page Not Found</h1>";
		return $msg;
	}

}