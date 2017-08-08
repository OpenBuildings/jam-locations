<?php

use Openbuildings\EnvironmentBackup as EB;
use PHPUnit\Framework\TestCase;

abstract class Testcase_Extended extends TestCase {

	public $env;
	
	public function setUp()
	{
		parent::setUp();
		Database::instance()->begin();

		$this->env = new EB\Environment(array(
			'static' => new EB\Environment_Group_Static(),
		));
	}

	public function tearDown()
	{
		Database::instance()->rollback();	
		
		$this->env->restore();

		parent::tearDown();
	}
}
