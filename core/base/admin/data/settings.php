<?php

namespace admin;

class settings
{
	/**
	 * Шаблоны
	 */
	private $sample = [];
	private $routes = [
		'main' => [
			'alias' => '',
			'btnText' => 'Главная AdminPanel',
			'btnTitle' => 'Admin Panel',
			'folder_name' => 'main/'
		],
		'login' => [
			'alias' => 'login',
			'btnText' => 'Логин',
			'btnTitle' => 'Вход/Выход из профиля Admin',
			'folder_name' => 'login/'
		],
		'company_info' => [
			'alias' => 'company_info',
			'btnText' => 'Данные о компании',
			'btnTitle' => 'Данные и контакты компании',
			'folder_name' => 'company_info/'
		],
		'system' => [
			'alias' => 'system',
			'btnText' => 'Сайт',
			'btnTitle' => 'Настройки сайта',
			'folder_name' => ''
		],

	];
	use \traits\BaseMethods;
}
