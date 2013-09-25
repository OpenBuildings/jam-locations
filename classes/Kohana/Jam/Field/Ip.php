<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    openbuildings\jam-locations
 * @author     Ivan K <ikerin@gmail.com>
 * @copyright  (c) 2013 OpenBuildings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
abstract class Kohana_Jam_Field_Ip extends Jam_Field_String {

	public function get(Jam_Validated $model, $value, $is_changed)
	{
		if ( ! $value AND ! $is_changed AND ! $model->loaded()) 
		{
			return Request::$client_ip;
		}

		return $value;
	}

	public function convert(Jam_Validated $model, $value, $is_loaded)
	{
		if ( ! $value AND ! $is_loaded AND ! $model->changed($this->name)) 
		{
			return Request::$client_ip;
		}

		return $value;
	}
}