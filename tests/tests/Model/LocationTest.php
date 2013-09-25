<?php

/**
 * @group model.location
 */
class Model_LocationTest extends Testcase_Extended {

	public function data_contains()
	{
		return array(
			array('Everywhere', 'Europe', TRUE),
			array('France', 'Europe', FALSE),
			array('Europe', 'France', TRUE),
			array('Europe', 'Australia', FALSE),
			array('France', 'France', TRUE),
		);
	}

	/**
	 * @dataProvider data_contains
	 * @covers Model_Location::contains
	 */
	public function test_contains($container, $item, $expected)
	{
		$container = Jam::find('location', $container);
		$item = Jam::find('location', $item);

		$this->assertEquals($expected, $container->contains($item));
	}
}