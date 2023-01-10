<?php

namespace system\functions;

/********************************************************************/
/* Проверки */
/********************************************************************/
class Validate
{

	/* Проверка регулярных выражений */
	public static function regexp($name, $str)
	{
		$str =  str::filter_inputs($str);

		if ($name === 'mail') {
			$regexp = '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{0,50}[0-9A-Za-z]?)|([0-9А-Яа-я]{1}[-0-9А-я\.]{0,50}[0-9А-Яа-я]?))@([-A-Za-z]{1,}\.){1,}[-A-Za-z]{2,})$/u';
		} elseif ($name === 'password') {
			$regexp = '/^[a-zA-Z0-9-_]{1,1}[a-zA-Z0-9-_]{6,18}[a-zA-Z0-9-_]{1,1}$/';
		} elseif ($name === 'login') {
			$regexp = '/^[a-zA-Z][a-zA-Z0-9-_]{0,28}[a-zA-Z0-9]$/u';
		} elseif ($name === 'name') {
			$regexp = '/(^[a-zA-Z][a-zA-Z]{0,28}[a-zA-Z]$)|(^[а-яА-Я][а-яА-Я]{0,28}[а-яА-Я]$)/u';
			if (preg_match("/[ё]/u", $str)) {
				$msg = 'Недопустимый символ "ё"';
				return [false, $msg];
				exit;
			} elseif (preg_match("/[Ё]/u", $str)) {
				$msg = 'Недопустимый символ "Ё"';
				return [false, $msg];
				exit;
			}
		} else {
			return [false];
			exit;
		}
		if (!preg_match($regexp, $str)) {
			return [false];
			exit;
		} else {
			return $str;
			exit;
		}
	}
	/* Выводит стек вызовов функций в массив */
	public static function debug_backtrace()
	{
		print_array_2(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
	}
}
