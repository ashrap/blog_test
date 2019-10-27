<?php




return [

	'site' => 'TestBLOG',

	'database' => [

		'connection' => 'mysql',

		'host' => '127.0.0.1',

		'dbname' => 'test_blog',

		'user_name' => 'login',

		'password' => 'password',

		'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]

	]

];
