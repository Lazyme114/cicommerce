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

	public function _get_best_array_key($data)
	{
		foreach($data as $key => $value) {
			if(!isset($key_with_highest_value)) {
				$key_with_highest_value = $key;
			} elseif($value > $data[$key_with_highest_value]) {
				$key_with_highest_value = $key;
			}
		}
		return $key_with_highest_value;
	}

	public function _get_dynamic_theme($count)
	{
		switch ($count) {
			case '1':
			$theme = "is-danger";
			break;

			case '2':
			$theme = "is-success";
			break;

			case '3':
			$theme = "is-primary";
			break;

			case '4':
			$theme = "is-warning";
			break;
			
			default:
			$theme = "is-danger";
			break;
		}

		return $theme;
	}

}