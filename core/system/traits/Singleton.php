<?php

namespace traits;
/* Синглтон без подключения файла */

trait Singleton_Controller
{
	private static $_instance = null;
	private  $root = null;
	private  $namespace = null;
	private $data = [];
	private function __construct()
	{
	}
	private function __clone()
	{
	}
	private function __wakeup()
	{
	}
	private static  function getInstance($param)
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
			if (isset($param['root'])  && $param['root'] != null && self::$_instance->root === null) {
				self::$_instance->root = $param['root'];
			}
			$class =  get_class();
			$class = explode('\\', $class);
			array_pop($class);
			self::$_instance->namespace = \system\functions\Arrays::implode($class, '\\', '', '\\');
		}
		return self::$_instance;
	}
	/**
	 * Функция возврата нужного метода
	 * @param string $method_name имя вызываемого метода
	 *  - root - корень папки
	 * - return - массив параметров которые нужно вернуть (['return' => ['method_name' => [param]]])
	 * @return false|mixed  Вернет результат выполнения метода или false
	 */
	public static function return($param = null)
	{

		if ($param === null) {
			$return = ['error' => 'empty parameter'];
		} elseif (!is_array($param)) {
			$return = ['error' => 'parameter is not an array'];
		} else {
			if (!isset($param['root'])) {
				$param['root'] = '';
			}
			self::getInstance($param);
			if (isset($param['return'])) {
				$class =  get_class();
				foreach ($param['return'] as $method_name => $data) {
					$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method_name);
					if (isset($check_ClassAndMethod['error'])) {
						$return = ['error' => \ExDetailsText::class_or_method($class, $method_name)];
					} else {
						$return = self::$method_name($data);
					}
				}
			}
		}
		return $return;
	}
	/** 
	 * Возврат свойств
	 * @param array|string $array_property Имя или массив имен свойств
	 * @return array Вернет результат выполнения метода или error
	 * */
	private static function return_property($array_property)
	{
		if (!is_array($array_property)) {
			$array_property = [$array_property];
		}
		$return = [];
		foreach ($array_property as $property_name) {
			if (isset(self::$_instance->$property_name)) {
				array_push($return, self::$_instance->$property_name);
			} else {
				$return = ['error' => 'parameter does not exist'];
				break;
			}
		}
		return $return;
	}
	/**
	 * Метод для сбора свойств из папки data
	 * @param array $param передаваемые параметры ['type' => [return_name]]
	 * @return array
	 */
	private static function return_Data($param)
	{
		if (self::$_instance->root === null) {
			$return = ['error' => 'parameter empty - root'];
		} else {
			if (!is_array($param)) {
				$return = ['error' => 'no isset or no string "type"'];
			} else {
				$root = self::$_instance->root . 'data/';
				$return = [];
				foreach ($param as $type => $return_names) {
					if (!is_array($return_names)) {
						$return_names = [$return_names];
					}
					foreach ($return_names as $return_name) {
						if (isset(self::$_instance->data[$return_name])) {
							$return[$return_name] = self::$_instance->data[$return_name];
						} else {
							$link = $root . $type . '.php';
							$include = \system\functions\sub::include($link);
							if (isset($include['error'])) {
								$return = ['error' => $include['error']];
								break;
							} else {
								$class =  self::$_instance->namespace . $type;
								$method = 'return_property';
								$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
								if (isset($check_ClassAndMethod['error'])) {
									$return = ['error' => \ExDetailsText::class_or_method($class, $method)];
									break;
								} else {
									$return += $class::$method($return_name);

									if (isset($return['link']) && !isset(self::$_instance->data['link'])) {
										$return['link'] = \system\functions\sub::add_root(self::$_instance->root, $return['link']);
									}
									if (isset($return['path']) && !isset(self::$_instance->data['path'])) {
										$return['path'] = \system\functions\sub::add_root(self::$_instance->root, $return['path']);
									}
									self::$_instance->data = $return;
								}
							}
						}
					}
				}
			}
		}
		return $return;
	}
}
