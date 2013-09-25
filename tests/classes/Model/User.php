<?php

class Model_User extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->behaviors(array(
				'location_auto' => Jam::behavior('location_auto', array(
					'locations' => array(
						'city' => 'city',
						'country' => 'country_name',
					)
				)),
			))
			->associations(array(
				'country' => Jam::association('belongsto', array('foreign_model' => 'location')),
				'city' => Jam::association('belongsto', array('foreign_model' => 'location')),
			))
			->fields(array(
				'id' => Jam::field('primary'),
				'name' => Jam::field('string'),
				'ip' => Jam::field('ip'),
			));
	}
}