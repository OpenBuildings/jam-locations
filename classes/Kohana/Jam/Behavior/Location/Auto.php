<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    openbuildings\shipping
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2013 OpenBuildings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class Kohana_Jam_Behavior_Location_Auto extends Jam_Behavior {

	public $_ip_field = 'ip';

	public $_locations = array();

	public function model_before_check(Jam_Model $model)
	{
		if ( ! $model->loaded() OR $model->changed($this->_ip_field))
		{
			$info = $this->geoip_record($model->{$this->_ip_field});

			foreach ($this->_locations as $association => $info_name) 
			{
				if (isset($info[$info_name]))
				{
					$model->{$association} = Jam::find_or_build('location', array('name' => $info[$info_name]));
				}
			}
		}
	}

	public function geoip_record($ip)
	{
		return @ geoip_record_by_name($ip);
	}
}
