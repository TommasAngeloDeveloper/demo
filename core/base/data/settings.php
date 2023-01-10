<?php

namespace base;

class settings
{
	/**
	 * Шаблоны
	 */
	private  $sample = [
		'route' => [
			'alias' => null,
			'btnText' => null,
			'btnTitle' => null,
			'status' => [
				'avtive' => false,
				'msg' => null
			],
			'view' => [
				'nav' => false,
				'footer' => false,
				'aside' => false
			]
		],
		'html' => [
			'Controller' => [
				'link' => false,
				'class' => null,
				'method' => null,
				'data' => [],
			],

		]

	];
	private  $routes = [
		'admin' => [
			'route' => [
				'alias' => 'AdminPanel',
				'btnText' => 'Admin',
				'btnTitle' => 'Настройки сайта',
				'status' => [
					'avtive' => true,
					'msg' => null
				],
			],
			'controller' => [
				'class' => 'admin\Controller',
				'method' => 'return',
				'data' => [],
			],
			'view' => [
				'nav' => false,
				'footer' => false,
				'aside' => false
			]
		]
	];
	use \traits\BaseMethods;
}
