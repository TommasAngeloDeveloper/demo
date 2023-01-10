<?php

namespace traits;

trait BaseMethods
{
	private static $_instance;
	/**
	 * Функция возврата нужного метода
	 * @param string $method_name имя вызываемого метода
	 * @return false|mixed  Вернет результат выполнения метода или false
	 */
	public static function return($method_name,  $param = null)
	{
		$return = null;
		if (is_string($method_name)) {
			$class = get_class();
			$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method_name);
			if (isset($check_ClassAndMethod['error'])) {
				$return = ['error' => \ExDetailsText::class_or_method($class, $method_name)];
			} else {
				$return = self::$method_name($param);
			}
		}
		return $return;
	}

	/** 
	 * Возврат свойств
	 * @param array|string $array_property Имя или массив имен свойств
	 * @return array Вернет результат выполнения метода или error
	 * */
	public static function return_property($array_property)
	{
		if (!is_array($array_property)) {
			$array_property = [$array_property];
		}
		self::$_instance = new self;
		$return = [];
		foreach ($array_property as $property) {
			if (isset(self::$_instance->$property)) {
				$return[$property] = self::$_instance->$property;
			} else {
				$return = ['error' => 'invalid property name - ' . $property];
				break;
			}
		}
		return $return;
	}
}
