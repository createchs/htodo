<?php

return [
	'basePath' => dirname(__DIR__),

	'name' => 'htodo',
	
	'language' => 'en',

	'preload' => ['log'],

	'import' => [
		'application.models.*',
		'application.models.base.*',
		'application.components.*',
		'application.behaviors.*',
		'application.helpers.*',
	],

	'modules' => [
		'gii' => [
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => ['127.0.0.1','::1'],
		],
	],

	'components' => [
		'user' => [
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		],

		'clientScript' => [
			'coreScriptPosition' => CClientScript::POS_END,
			'defaultScriptFilePosition' => CClientScript::POS_END,
			'scriptMap' => [
				'jquery.js' => false,
			],
		],

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager' => [
			'urlFormat' => 'path',
			'rules' => [
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			],
		],
		*/
		
		'db' => require __DIR__ . '/db.php',
		
		'errorHandler' => [
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		],

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

	'params' => [],
];