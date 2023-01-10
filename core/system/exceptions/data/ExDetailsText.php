<?php

class ExDetailsText
{
	private static $lang = 'eng';
	/***************************************************************************/
	/* Отсутствует класс или метод */
	/**
	 * Отсутствует класс или метод
	 * @param mixed $link текущая ссылка подключения
	 * @param string $comment дополнительный коментарий
	 * @return string
	 */
	public static function class_or_method($class = false, $method = false, $comment = '')
	{
		if ($comment !== '') {
			$comment = '"' . $comment . '"';
		}
		if (self::$lang == 'eng') {
			if ($class && $method) {
				return 'no class or method ' . $comment . ': class - ' . $class  . ' | method - ' . $method;
			} else if ($class && !$method) {
				return 'no class' . $comment . ': class - ' . $class;
			} else if (!$class && $method) {
				return 'no method' . $comment . ': method - ' . $method;
			} else {
				return 'empty class or method' . $comment . ': class - ' . $class  . ' | method - ' . $method;
			}
		}
	}
	public static function empty($msg)
	{
		if (self::$lang == 'eng') {
			return 'empty - ' . $msg;
		}
	}
	public static function isset($msg)
	{
		if (self::$lang == 'eng') {
			return 'no isset - ' . $msg;
		}
	}
	/**
	 * Не удается подключить файл
	 * @param mixed $link текущая ссылка подключения
	 * @param string $comment дополнительный коментарий
	 * @return string
	 */
	public static function include($link, $comment = '')
	{
		if ($comment !== '') {
			$comment = '"' . $comment . '"';
		}

		if (self::$lang == 'eng') {
			return 'no include ' . $comment . ' - link: ' . $link;
		}
	}

	/**
	 * Не удается подключить файл
	 * @param mixed $link текущая ссылка подключения
	 * @param string $comment дополнительный коментарий
	 * @return string
	 */
	public static function is_array($msg = null)
	{
		if (self::$lang == 'eng') {
			return 'parameter is not an array';
		}
	}
	public static function file_exist($msg)
	{
		if (self::$lang == 'eng') {
			return 'no file exist - path: ' . $msg;
		}
	}
}
