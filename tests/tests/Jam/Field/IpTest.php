<?php

/**
 * @group jam.field.ip
 */
class Jam_Field_IpTest extends Testcase_Extended {

	public function data_construct()
	{
		return array(
			array('0.0.0.0', '0.0.0.0'),
			array('129.23.21.43', '129.23.21.43'),
			array(NULL, NULL),
		);
	}

	/**
	 * @dataProvider data_construct
	 * @covers Jam_Field_Ip::get
	 * @covers Jam_Field_Ip::convert
	 */
	public function test_construct($ip, $expected)
	{
		$this->env->backup_and_set(array(
			'Request::$client_ip' => $ip,
		));

		$user = Jam::build('user');

		$this->assertEquals($expected, $user->ip);

		$user->ip = 'TEST';
		$this->assertEquals('TEST', $user->ip);

		$user->ip = NULL;
		$this->assertEquals(NULL, $user->ip);

		$user->save();

		$user = Jam::find('user', $user->id());
		$this->assertEquals(NULL, $user->ip);

		$user->ip = $ip;
		$user->save();

		$user = Jam::find('user', $user->id());
		$this->assertEquals($expected, $user->ip);

		$user = Jam::build('user');
		$user->save();

		$user = Jam::find('user', $user->id());
		$this->assertEquals($expected, $user->ip);
	}
}