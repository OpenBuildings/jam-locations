<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    openbuildings\shipping
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2013 OpenBuildings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class Kohana_Jam_Behavior_Location_Parent extends Jam_Behavior {

	public $_parents = array();

	public function model_before_check(Jam_Model $model)
	{
		foreach ($this->_parents as $child => $parent) 
		{
			$child_association = $model->meta()->association_insist($child);
			$parent_association = $model->meta()->association_insist($parent);

			if ($model->changed($child) AND $model->{$child} AND ! $model->{$child}->parent AND $model->{$parent}) 
			{
				$model->{$child}->parent = $model->{$parent};
			}
		}
	}
}
