<?php

namespace core;

use Ex;

class launch
{

	private const version = '1.0.0';
	private static $add = [];
	private static $sample = [];
	private static $links = [];
	private static $routes = [];
	private static $controllers = [];
	private const controllers_base = [
		'root' => 'core/base/',
		'link' => 'Controller.php',
		'class' =>  'Controller',
		'namespace' => 'base\\',
	];
	private static  $settings = [
		'title_page' => [
			'status' => true,
			'value' => null
		],
		'mobile' => false,
		'routes' => [],	// Список маршрутов	
		'html' => [
			'_html' => [
				'link' => null
			],
			'meta' => [
				'Controller' => [],
				'data' => [
					'mobile' => false,
					'title' => [
						'value' => null
					],
					'title_prefix' => [
						'status' => false,
						'value' => null
					],
					'description' => null,
					'keywords' => null,
					'favico' => null,
					'css' => [],
					'js' => [],
				],
			],
		],
		'add' => [],
	];

	/****************************************************************************************/
	/* Основной метод */
	/****************************************************************************************/
	public static function launch()
	{
		//	['root' => 'core/', 'return' => ['return_property' => 'root']]
		/* Запускаем Базовый контроллер */
		self::include_Base();
		/* Запускаем  Контроллер Шаблона */
		//	self::include_Layout();
		/* Главный Роутер */

		self::Router();
		// Добавляем все дополнения в глобальный список
		self::add_list_adds();
		//	return $this->_instance;
		return self::$settings;
	}
	/****************************************************************************************/
	/* Запускаем Базовый контроллер */
	/****************************************************************************************/
	private static function include_Base()
	{
		$root =  'core/base/';
		$link  = $root . 'Controller.php';
		$include = \system\functions\sub::include($link);
		if (isset($include['error'])) {
			new Ex($include['error']);
		} else {
			$namespace = self::controllers_base['namespace'];
			$class = 	$namespace  . self::controllers_base['class'];
			$method = 'return';
			// Получаем дата данные
			$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
			if (isset($check_ClassAndMethod['error'])) {
				new Ex($check_ClassAndMethod['error']);
			} else {
				$result = $class::$method(['root' => $root, 'return' => [
					'return_Data' => [
						'data' => ['link', 'path'],
						'settings' => ['routes'],
						'config' => ['config'],
					]
				]]);
				if (isset($result['error'])) {
					new \Ex($result['error']);
				} else {

					// Добавляем в список css файл
					self::add_css($result['link']['css']);
					// Добавляем в список js файл
					self::add_js($result['link']['js']);
					// Заменяем  мета данные
					//		self::$settings['html']['meta']['data'] = \ta\sub::add_array_by_key(self::$settings['html']['meta']['data'], $return['config']['meta']);
					// Добавляем путь до html meta
					self::$settings['html']['meta']['Controller']['link'] = $result['link']['meta'];
					// Добавляем класс meta
					self::$settings['html']['meta']['Controller']['class'] = 'core\base\meta';
					// Добавляем имя макета
					self::$settings['layout']['name'] = $result['config']['layout_name'];
					// добавляем маршруты
					self::$routes = $result['routes'];
					// добавляем контроллер admin
					self::$controllers['admin'] = [
						'root' =>  $result['path']['admin'],
						'class' => 'admin\Controller',
					];
					// Добавляем контроллер макета
					self::$controllers['layout'] = [
						'root' => 'core/layout/' . $result['config']['layout_name'] . '/',
						'class' => 'layout\Controller',
					];
					// Получаем список дополнений и добавляем контроллеры в общий список
					self::add_adds($result['path']['add']);
				}
			}
		}
	}
	/****************************************************************************************/
	/* Запускаем  Контроллер Шаблона */
	/****************************************************************************************/

	private static function include_Layout()
	{
	}

	private static function Router()
	{
		// Текущий URL
		$url = url_now();
		//$url = $_SERVER['REQUEST_URI'];
		// Перенаправляем на адресс без слеша
		if (strrpos($url,	'/') === strlen($url) - 1 && strrpos($url, '/') !== 0) {
			redirect_page(rtrim($url, '/'));
		}

		// Превращаем адресную страку в массив по разделителю
		$url_array = explode('/', substr($url, 1));
		// По умолчанию главная страница (Если существует)
		if (isset(self::$routes['main'])) {
			$view = self::$routes['main'];
		}
		// Проверяем есть ли в первой строке символ
		if (isset($url_array[0])) {
			$namespace = self::controllers_base['namespace'];
			$class = 	$namespace  . self::controllers_base['class'];
			$method = 'return';
			$route_check = $class::$method(['return' => [
				'return_Data' => [
					'settings' => ['routes'],
				]
			]]);
			if (isset($result['settings']['error'])) {
				new \Ex($result['settings']['error']);
			};
			if ($url_array[0] === $route_check['routes']['admin']['route']['alias'] && self::$routes['routes']['admin']['route']['alias'] === $route_check['admin']['route']['alias']) {

				$root = self::$controllers['admin']['root'];
				$link = $root . 'Controller.php';
				$class =  $route_check['routes']['admin']['controller']['class'];
			} else {
				new \Ex('страница не найдена');
			}
		} else {
			new \Ex('страница не найдена');
		}

		$include = \system\functions\sub::include($link);

		if (isset($include['error'])) {

			new Ex($include['error']);
		} else {
			$method = 'launch';
			// Получаем дата данные
			$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
			if (isset($check_ClassAndMethod['error'])) {
				new Ex($check_ClassAndMethod['error']);
			} else {
				//	$result['data'] = $class::$method(['return_name' => ['link', 'path'], 'type' => 'data', 'root' => $root]);
				$result = $class::$method(['root' => $root, 'url_array' => $url_array]);
				if (isset($result['data']['error'])) {
					new \Ex($result['data']['error']);
				}

				// Заменяем  мета данные
				self::$settings['html']['meta']['data'] = \system\functions\sub::add_array_by_key(self::$settings['html']['meta']['data'], $result['html']['meta']['data']);
				// добавляем html разметку
				self::$settings['html']['_html'] = $result['html']['_html'];
				// добавляем данные вида
				self::$settings['html']['view'] =   $result['html']['view'];
				// Добавляем в список css файл
				self::add_css($result['html']['meta']['css']);
				// Добавляем в список js файл
				self::add_js($result['html']['meta']['js']);
			}
		}
	}
	/****************************************************************************************/
	/* Добавляем в список css файл */
	/****************************************************************************************/
	private static function add_css($css)
	{
		// Список файлов для копирования и переноса css файлов
		\system\functions\sub::transfer_css($css);
		// добавляем файлы css
		$css = \system\functions\sub::add_css(self::$settings['html']['meta']['data']['css'], $css);
		if ($css) {
			self::$settings['html']['meta']['data']['css'] = $css;
		}
	}

	/****************************************************************************************/
	/* Добавляем в список js файл */
	/****************************************************************************************/
	private static function add_js($js)
	{
		self::$settings['html']['meta']['data']['js'] = \system\functions\sub::add_js(self::$settings['html']['meta']['data']['js'], $js);
	}
	/**
	 * Получить дополнения и добавить их в список
	 */
	private static function add_adds($root_adds)
	{
		$list_add = \FoldersAndFiles::folder_ListFolders($root_adds);
		if (empty($list_add)) {
			new \Ex(\ExDetailsText::empty('list_add'));
		} else {
			foreach ($list_add as $add) {
				$root =  $root_adds . $add . '/';
				$link = $root  . 'Controller.php';
				$include = \system\functions\sub::include($link);
				if (isset($include['error'])) {
					new Ex($include['error']);
				} else {
					$class = 'base\add\\' . $add . '\\Controller';
					$method = 'return';
					$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
					if (isset($check_ClassAndMethod['error'])) {
						new \Ex(\ExDetailsText::class_or_method($class, $method, 'base/add/' . $add));
					} else {
						$result_add = $class::$method(['root' => $root, 'return' => [
							'return_Data' => [
								'data' => ['link', 'path'],
								'settings' => ['settings'],
								'config' => ['config'],
							]
						]]);
						if (isset($result['error'])) {
							new \Ex($result['error']);
						}
						if (isset($result_add['error'])) {
							new Ex($result_add['error']);
						} else {
							if (isset(self::$settings['add'][$add])) {
								new \Ex('Дополнение с таким именем уже существует: ' . $add);
							} else {
								// Добавляем в список css файл
								self::add_css($result_add['link']['css']);
								// Добавляем в список js файл
								self::add_js($result_add['link']['js']);
								self::$add[$add]['Controller'] = [
									'link' => $link,
									'class' => $class,
									'method' => $method,
									'method_name' => 'html',
									'data' => null,
								];
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Добавит в глобальную константу все дополнения
	 */
	private static function add_list_adds()
	{
		define('add', self::$add);
	}
}
