<?php

/**
 * @group jam.behavior.location_auto
 */
class Jam_Behavior_Location_AutoTest extends Testcase_Extended {

	/**
	 * @covers Jam_Behavior_Location_Auto::geoip_record
	 */
	public function test_geoip_record()
	{
		$behavior = new Jam_Behavior_Location_Auto();

		$result = $behavior->geoip_record('66.102.0.0');

		$expected = array(
			'continent_code' => 'NA',
			'country_code' => 'US',
			'country_code3' => 'USA',
			'country_name' => 'United States',
			'region' => 'CA',
			'city' => 'Mountain View',
			'postal_code' => '94043',
			'latitude' => '37.419200897217',
			'longitude' => '-122.05740356445',
			'dma_code' => '807',
			'area_code' => '650',
		);

		$this->assertEquals($expected, $result);
	}

	public function data_model_before_check()
	{
		return array(
			array('66.102.0.0', array('city' => 'London', 'country_name' => 'United Kingdom'), array('city' => 'London', 'country' => 'United Kingdom')),
			array('66.102.0.1', array('city' => 'Paris', 'country_name' => 'France'), array('city' => 'Paris', 'country' => 'France')),
		);
	}

	/**
	 * @dataProvider data_model_before_check
	 * @covers Jam_Behavior_Location_Auto::model_before_check
	 */
	public function test_model_before_check($ip, $geoip_record, $expected)
	{
		$this->env->backup_and_set(array('Request::$client_ip' => $ip));

		$user = Jam::build('user');
		$behavior = $this->getMock('Jam_Behavior_Location_Auto', array('geoip_record'), array(array('locations' => array('city' => 'city', 'country' => 'country_name'))));

		$behavior
			->expects($this->once())
			->method('geoip_record')
			->with($this->equalTo($ip))
			->will($this->returnValue($geoip_record));

		$behavior->model_before_check($user);

		foreach ($expected as $attribute => $value) 
		{
			$this->assertInstanceOf('Model_Location', $user->{$attribute});
			$this->assertEquals($value, $user->{$attribute}->name());
		}
	}

}