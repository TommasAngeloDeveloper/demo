<?php

namespace view;

class config
{
	private $config  = [
		'meta' => [
			'title' => [
				'value' => 'Login'
			],
			'description' => 'Вход в AdminPanel',
			'keywords' => 'TEST',
		],
		'require' => null,
	];
	use \traits\BaseMethods;
}
