<?php 

require_once __DIR__.'/../vendor/autoload.php';

Kohana::modules(array(
	'database'         => MODPATH.'database',
	'jam'              => MODPATH.'jam',
	'jam-closuretable' => MODPATH.'jam-closuretable',
	'jam-locations'    => __DIR__.'/..',
));

Kohana::$config
	->load('database')
		->set('default', array(
			'type'       => 'PDO',
			'connection' => array(
                'dsn'        => 'mysql:dbname=test-jam-locations;host=127.0.0.1',
                'username'   => 'root',
                'password'   => '',
                'persistent' => TRUE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
        ));

Kohana::$environment = Kohana::TESTING;
