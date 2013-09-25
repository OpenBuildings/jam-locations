<?php

class Model_Address extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->behaviors(array(
				'location_parent' => Jam::behavior('location_parent', array(
					'parents' => array(
						'city' => 'country',
					)
				)),
			))
			->associations(array(
				'country' => Jam::association('belongsto', array('foreign_model' => 'location')),
				'city' => Jam::association('belongsto', array('foreign_model' => 'location')),
			))
			->fields(array(
				'id' => Jam::field('primary'),
				'email' => Jam::field('string'),
				'phone' => Jam::field('string'),
			));
	}
}