<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * @package    openbuildings\jam-locations
 * @author     Ivan K <ikerin@gmail.com>
 * @copyright  (c) 2013 OpenBuildings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 *
 * @property int    $id
 * @property string $name
 * @property string $short_name
 * @property string $type
 */
class Kohana_Model_Location extends Jam_Model {

	/**
	 * @codeCoverageIgnore
	 */
	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->behaviors(array(
				'closuretable' => Jam::behavior('closuretable'),
			))
			
			->fields(array(
				'id' => Jam::field('primary'),
				'name' => Jam::field('string'),
				'short_name' => Jam::field('string'),
				'type' => Jam::field('string'),
			))

			->validator('name', array('present' => TRUE));
	}

	public function contains(Model_Location $location)
	{
		return (($this->id() == $location->id()) OR $this->is_ansestor_of($location));
	}
}