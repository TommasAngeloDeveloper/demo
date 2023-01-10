<?php

namespace system\functions;

class SystemSettingFunctions
{
	// // Включение или отключение вывода ошибок на сайте
	public static function error($flag)
	{
		if ($flag === false) {
			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			error_reporting(E_ALL);
		}
	}
}
