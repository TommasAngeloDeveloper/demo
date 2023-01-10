<?php

namespace admin;

class config
{
	private $config = [
		'meta' => [
			'title_prefix' => [
				'status' => true,
				'value' => 'AdminPanel'
			],
			'title_page' => [
				'status' => true,
				'value' => false
			]
		]
	];
	use \traits\BaseMethods;
}
