<?php

namespace system\functions;

class sub
{
	/** 
	 *  Добавление значений массива по совпадающим ключам
	 * @param array $array массив в кторой добавляем
	 * @param array $array_add  массив который добавляем
	 * @param bool $empty  Перезаписывать пустые значения? (true - перезапишет значение, даже если оно пустое)
	 * @return $array Вернет массив $array
	 * */
	public static function add_array_by_key($array, $array_add, $empty = false)
	{
		if (empty($array)) {
			$array = [];
		}
		foreach ($array as $key => $result) {
			if (isset($array_add[$key])) {
				if (is_array($result) && is_array($array_add[$key])) {
					$array[$key] = self::add_array_by_key($array[$key], $array_add[$key]);
				} else if (!is_array($result) && !is_array($array_add[$key])) {
					if (!empty($array_add[$key])) {
						$array[$key] = $array_add[$key];
					} else {
						if ($empty === true) {
							$array[$key] = $array_add[$key];
						}
					}
				}
			}
		}
		return $array;
	}
	/** 
	 *  Добавление значений массива по шаблону
	 * @param array $sample массив шаблон
	 * @param array $array_add  массив который добавляем
	 * @return null|array $array Вернет массив $array
	 * */
	public static function add_array_by_sample($sample,  $array_add)
	{
		function formation($sample,  $array_add)
		{
			$new_array = $sample;
			if (is_array($sample)) {
				foreach ($sample as $key => $result) {
					if (is_array($result)) {
						if (isset($array_add[$key])) {
							$new_array[$key] = formation($sample[$key], $array_add[$key]);
						}
					} else {
						if (isset($array_add[$key])) {
							$new_array[$key] = $array_add[$key];
						}
					}
				}
			}
			return $new_array;
		}
		$return = [];
		if (is_array($array_add)) {
			foreach ($array_add as $key => $result) {
				$return[$key] = formation($sample, $result);
			}
		}
		return $return;
	}
	/** 
	 *  Добавляем в список css файл 
	 * @param array $css массив css ссылок
	 * @param array $css_add  массив который добавляем
	 * @return false|array $css - Возвращает сформированный массив
	 * */
	public static function add_css($css, $css_add)
	{

		if (is_array($css_add)) {
			$key_css  = 'css';
			$key_css_m  = 'css_m';
			foreach ($css_add as $key => $result) {
				$new_css = false;
				if (!is_dir($result['css_min']) && file_exists($result['css_min'])) {

					$new_css[$key_css] = $result['css_min'];
				} else {
					$new_css[$key_css] = null;
				}
				if (file_exists($result['css_min_m'])) {
					$new_css[$key_css_m] = $result['css_min_m'];
				} else {
					$new_css[$key_css_m] = null;
				}
				if ($new_css) {
					if (is_int($key)) {
						array_push($css, $new_css);
					} else {
						$new_css = [$key => $new_css];
						$css += $new_css;
					}
				}
			}
			return $css;
		} else {
			return false;
		}
	}

	/**
	 * Добавляем в список js файл
	 * @param array $js массив в который нужно добавить
	 * @param string|array $js_add массив или значение который нужно добавить
	 * @return array $js Вернет массив с добавленными значениями $js_add
	 */
	public static  function add_js($js, $js_add)
	{
		if (is_array($js_add)) {
			foreach ($js_add as $key => $result) {
				if (is_array($result)) {

					foreach ($result as $key_2 => $result_2) {
						if (is_string($result_2)) {
							if (!is_dir($result_2) && file_exists($result_2)) {
								if (is_int($key_2)) {
									array_push($js, $result_2);
								} else {
									$result_2 = [$key_2 => $result_2];
									$js += $result_2;
								}
							} else {
								if (is_int($key_2)) {
									array_push($js, null);
								} else {
									$result_2 = [$key_2 => null];
									$js += $result_2;
								}
							}
						}
					}
				} else if (is_string($result)) {

					if (!is_dir($result) && file_exists($result)) {
						if (is_int($key)) {
							array_push($js, $result);
						} else {
							$result = [$key => $result];
							$js += $result;
						}
					} else {
						if (is_int($key)) {
							array_push($js, null);
						} else {
							$result = [$key => null];
							$js += $result;
						}
					}
				}
			}
		}
		return $js;
	}

	/**
	 * Подготовка к переносу файлов
	 * @param array $array_css массив ссылок для переноса
	 */
	public static function transfer_css($array_css)
	{
		if (defined('editor')) {
			$editor = editor;
		} else {
			$editor = false;
		}
		if ($editor === true) {
			if (function_exists('transfer_css')) {
				$list_transfer_css = [];
				if (is_array($array_css)) {
					foreach ($array_css as $css) {
						if (is_array($css)) {
							foreach ($css as $result) {
								if (!is_array($result)) {
									$array = explode('/', $result);
									$file = end($array);
									array_pop($array);
									$path = implode('/', $array) . '/';
									array_push($list_transfer_css, [
										'new_folder' => $path,
										'file_name' =>  $file,
									]);
								}
							}
						}
					}
					//print_array_1($list_transfer_css, false);
					transfer_css($list_transfer_css);
				}
			}
		}
	}

	/**
	 * Добавить корень ко всем путям
	 * @param string $root путь который нужно добавить в начало строки
	 * @param string|array $path путь или массив путей к которым добавлять
	 * @return string|array $return Вернет строку или массив $root + $path
	 */
	public static function add_root($root, $path)
	{
		if (is_array($path)) {
			foreach ($path as $key => $result) {
				if (is_array($result)) {
					$return[$key] = self::add_root($root, $result);
				} else {
					$return[$key] = $root . $result;
				}
			}
		} else {
			$return = $root . $path;
		}
		return $return;
	}
	/****************************************************************************************/
	/* Подготовка маршрута (Возвращает путь подключения контроллера с видом страницы */
	/****************************************************************************************/
	public static function formation_route($route, $root)
	{
		if (is_array($route)) {
			$routes = [];
			foreach ($route as $name_route => $route) {
				if (isset($route['alias']) && isset($route['btnText'])) {
					foreach ($route as $key => $result) {
						$routes[$name_route][$key] = $result;
					}
					$routes[$name_route]['root'] = $root;
					$routes[$name_route]['Controller']['link'] =  $root . $route['Controller']['link'];
				}
			}
			return $routes;
		}
		return false;
	}
	/****************************************************************************************/
	/* Получить список файлов в папке */
	/****************************************************************************************/
	public static function listFiles($path, $all_files = false)
	{

		if (class_exists('FoldersAndFiles')) {

			if (method_exists('FoldersAndFiles', 'file_allFileName')) {
				$result =  \FoldersAndFiles::file_allFileName($path, $all_files);
				if ($all_files === false) {
					if (file_exists($path . $result)) {
						return $path .  $result;
					}
				} else if (is_array($result)) {
					return $result;
				}
			}
		}
	}
	/****************************************************************************************/
	/* Получить список папок в папке */
	/****************************************************************************************/
	public static function listFolders($path)
	{

		if (class_exists('FoldersAndFiles')) {
			if (method_exists('FoldersAndFiles', 'folder_ListFolders')) {
				$return = \FoldersAndFiles::folder_ListFolders($path);
				if ($return) {
					return $return;
				}
			}
		}
		return false;
	}

	/****************************************************************************************/
	/* Получить файл с картинкой в папке */
	/****************************************************************************************/
	public static function return_img($settings)
	{
		if (isset($settings['img']) && is_array($settings['img'])) {
			$array_img = [];
			foreach ($settings['img'] as $key => $img) {
				$array_img[$key] = self::listFiles($img);
			}
			return $array_img;
		}
		return false;
	}

	/****************************************************************************************/
	/* рекурсия массива */
	/****************************************************************************************/
	public static function recursive($key, $result, $value)
	{
		foreach ($result as $key_2 => $result_2) {
			if (is_array($result_2)) {
				$return[$key_2] = self::recursive($key, $result_2, $value);
			} else {
				$return[$key_2] = $value . $result_2;
			}
		}
		return $return;
	}

	/**
	 * Проверка на подключение файла
	 * @param string $link Ссылка подключения
	 * @return bool Вернет true,если файл уже подключен или false,если нет
	 *  */
	public static function include($link)
	{

		$link = $_SERVER['DOCUMENT_ROOT'] . '/' . $link;
		$result = arrays::in_array(get_included_files(), \system\functions\Str::editSimvol($link, '/', '\\'));
		if (!$result) {
			if (!@include_once($link)) {
				return  ['error' => \ExDetailsText::include($link)];
			}
		}
	}

	/**
	 * Проверить класс и метод
	 * @param string $class имя класса
	 * @param bool|string $method имя метода (не обязательный параметр)
	 * @return bool Вернет true | false
	 */
	public static function check_ClassAndMethod($class, $method = false)
	{
		if (!empty($class) && !empty($method)) {
			if (class_exists($class)) {
				if (!method_exists($class, $method)) {
					return ['error' => \ExDetailsText::class_or_method($class, $method)];
				}
			} else {
				return ['error' => \ExDetailsText::class_or_method($class)];
			}
		} else if (!empty($class) && $method === false) {
			if (!class_exists($class, false)) {
				return ['error' => \ExDetailsText::class_or_method($class)];
			}
		} else {
			return ['error' => \ExDetailsText::class_or_method($class, $method)];
		}
	}
}
