<?php 

spl_autoload_register(function($class)
{
	$file = __DIR__.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.str_replace('_', '/', $class).'.php';

	if (is_file($file))
	{
		require_once $file;
	}
});

require_once __DIR__.'/../vendor/autoload.php';

Kohana::modules(array(
	'database'         => MODPATH.'database',
	// 'auth'            => MODPATH.'auth',
	'jam'              => __DIR__.'/../modules/jam',
	'jam-closuretable' => __DIR__.'/../modules/jam-closuretable',
	'template-module'  => __DIR__.'/..',
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
