<?php

namespace admin;

use ExDetailsText;

class Controller
{
	private static $settings = [
		'generic' => [],
		'view' => []
	];
	use \traits\Singleton_Controller;

	public static function launch($param)
	{
		if (!isset($param['root'])) {
			$param['root'] = null;
		}
		self::$settings['generic'] +=  self::return(['root' => $param['root'], 'return' => [
			'return_Data' => [
				'data' => ['link', 'path'],
				'config' => ['config'],
				'routes' => ['routes'],
				'auth' => ['login'],
			]
		]]);
		if (isset($result['generic']['error'])) {
			new \Ex($result['generic']['error']);
		}
		//	self::$settings['view'] += self::return('Router', $param['url_array']);
		self::$settings['view'] +=  self::return([
			'root' => $param['root'], 'return' => [
				'Router' =>
				$param['url_array']
			]
		]);
		if (isset(self::$settings['view']['error'])) {
			new \Ex(self::$settings['view']['error'], '', 10);
		}
		$result = self::$settings;
		self::$_instance->param = $result;

		$return = [
			'html' => [
				'_html' => [
					'link' => $result['generic']['link']['html'],
					'class' => self::$_instance->namespace . 'html',
				],
				'meta' => [
					'css' => $result['generic']['link']['css'] += $result['view']['link']['css'],
					'js' => $result['generic']['link']['js'] += $result['view']['link']['js'],
					'data' => $result['view']['config']['meta'],
				],
				'view' => [
					'class' =>  'view\Controller',
					'method' =>  'return',
					'data' => [
						'routes' => 	$result['generic']['routes'],
					],
				],

			]
		];

		return $return;
	}
	private static function Router($url_array)
	{
		$return = ['error' => 'view not found'];
		$path_views = self::$_instance->data['path']['views'];
		$routes = self::$_instance->data['routes'];
		foreach ($routes as $result) {
			if ($result['alias'] === $url_array[1]) {
				$route = $result;
				$root = $path_views . $route['folder_name'];
				$link = $root . 'Controller.php';
				$include = \system\functions\sub::include($link);
				if (isset($include['error'])) {
					new \Ex($include['error'], 'page', 10);
				} else {
					$class = 'view\Controller';
					$method = 'return';
					$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
					if (isset($check_ClassAndMethod['error'])) {
						new \Ex($check_ClassAndMethod['error']);
					} else {
						$result = $class::$method(['root' => $root, 'return' => [
							'return_Data' => [
								'data' => ['link', 'path'],
								'config' => ['config'],
							]
						]]);
						if (isset($result['error'])) {
							new \Ex($result['error']);
						} else {
							$return = $result;
						}
					}
				}
				break;
			}
		}
		return $return;
	}

	public static function authorization($login, $password)
	{

		$result = self::$_instance->data['login'];
		if (!isset($result['login']) || empty($result['login'])) {
			new \Ex(ExDetailsText::empty('login'));
		} elseif (!isset($result['password']) || empty($result['password'])) {
			new \Ex(ExDetailsText::empty('password'));
		} else {
			if ($result['login'] === $login &&   password_verify($password, $result['password'])) {
				$msg = 'верный логин или пароль';
				array_push($_SESSION['msg']['true'], $msg);
				if (isset($_SESSION['authorization'])) {
					unset($_SESSION['authorization']);
				}
			} else {
				$msg = 'Неверный логин или пароль';
				array_push($_SESSION['msg']['false'], $msg);
				$_SESSION['authorization'] = [
					'login' => $login,
					'password' => $password
				];
			}
		}
	}
}
