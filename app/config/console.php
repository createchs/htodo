<?php

return [
	'basePath' => dirname(__DIR__),
	
	'name' => 'Console App',

	'preload' => ['log'],
	
	'import' => [
		'application.models.*',
		'application.models.base.*',
		'application.components.*',
		'application.behaviors.*',
		'application.helpers.*',
	],

	'components' => [
		'db' => require __DIR__ . '/db.php',

		'log' => [
			'class' => 'CLogRouter',
			'routes' => [
				[
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				],
			],
		],
	],
];