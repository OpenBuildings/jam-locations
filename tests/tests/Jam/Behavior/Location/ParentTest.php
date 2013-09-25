<?php

/**
 * @group jam.behavior.location_parent
 */
class Jam_Behavior_Location_ParentTest extends Testcase_Extended {

	/**
	 * @covers Jam_Behavior_Location_Parent::model_before_check
	 */
	public function test_model_before_check()
	{
		$france = Jam::find('location', 'France');
		$address = Jam::build('address');

		$address->city = Jam::build('location', array('name' => 'Paris'));
		$address->country = $france;

		$address->check();

		$this->assertEquals($france, $address->city->parent);

		$address->save();

		$paris = Jam::find('location', 'Paris');
		$this->assertEquals($france, $paris->parent);
	}
}