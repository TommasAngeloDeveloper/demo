<?php

@include_once('class/Mail.php');	/* Отправка Почты */
@include_once('class/SystemSettingFunctions.php');	/* Системные настройки */
@include_once('class/Date.php');	/* Работа с датой (данными) */
@include_once('class/Str.php');	/* Работа со строками */
@include_once('class/Numbers.php');	/* Работа с числами */
@include_once('class/Arrays.php');	/* Работа с Массивами */
@include_once('class/FoldersAndFiles.php');	/* Работа с папками + файлами */
@include_once('class/Validate.php');	/* Проверки */
@include_once('class/DataBase.php');	/* Работа с Базами Данных */
@include_once('class/TABLE.php');	/* Работа с Таблицами */
@include_once('class/_sub.php');	/* Вспомагательные функции */

/**
 * Определение мобильного устройства
 * @return bool Вернет (true|false)
 */
function check_mobile_device()
{
	$mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	foreach ($mobile_agent_array as $value) {
		if (strpos($agent, $value) !== false) return true;
	}
	return false;
}
/**
 *  Текущий url
 * @param bool|string Параметры возварата
 * - "1" (По умолчанию) Только основной путь - /category/page
 * - "2" Основной путь и GET-параметры - /category/page?sort=asc
 * - "3" Только GET-параметры - sort=asc
 * - "4" Полный URL - https:// example.com/category/page?sort=asc
 * - "5" URL без GET-параметров - https: //example.com/category/page
 * @return string  Вернет текущий url или false
 */
function url_now($url = 1)
{
	if ($url == 1) {
		$url = $_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		$url = $url[0];
	} else if ($url == 2) {
		$url = $_SERVER['REQUEST_URI'];
	} else if ($url == 3) {
		$url = $_SERVER['QUERY_STRING'];
	} else if ($url == 4) {
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	} else if ($url == 5) {
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		$url = $url[0];
	} else {
		$url = false;
	}
	return $url;
}

/**
 *  Функция перенаправления
 * @param bool|string $url url на который перенаправить
 * - "false" (По умолчанию) Перенаправит на главную страницу
 * - "true" Перенаправит на текущую страницу
 * - "string" Перенаправит на указанный url.
 * @return void ни чего не вернет
 */
function redirect_page($url = false)
{
	if ($url === true) {
		$url = $_SERVER['REQUEST_URI'];
	} else if ($url === false) {
		$url = '/';
	} else {
		if (is_string($url)) {
			$url = $url;
		} else {
			$url = '/';
		}
	}

	header('Location: ' . $url);
}

/**
 * Показать массив v.1
 * @param mixed $value значение (массив), которое нужно показать
 * @param bool $end остановить выполнение скрипта в конце?
 * @return void
 */
function print_array_1($value, $end = true)
{
	$bg = 'rgba(255, 215, 0,1)';
	echo '<pre style="background:' . $bg . '; font-size:14px; text-align: left;">';
	print_r($value);
	echo '</pre>';
	if ($end) {
		die('end');
	} else {
		echo ' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ';
	}
}

/**
 * Показать массив v.2
 * @param mixed $value значение(массив), которое нужно показать
 * @param bool $end остановить выполнение скрипта в конце?
 * @return void
 */
function print_array_2($value, $end = true)
{
	$bg = 'rgba(255, 215, 0,1)';
	echo '<pre style="background:' . $bg . '; font-size:14px; text-align: left;">';
	var_dump($value);
	echo '</pre>';
	if ($end) {
		die('end');
	} else {
		echo ' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ';
	}
}
/**
 * Проверить пустая ли переменная или массив обрезая пробелы в начале и конце строки
 * @param string|array $var проверяемая переменная или массив
 * @return bool Вернет true | false
 */
function is_empty($var)
{

	if (!is_array($var)) {
		if (!is_bool($var) && !is_int($var)) {
			return empty(trim($var));
		} else {
			return false;
		}
	} else {
		return empty($var);
	}
}


/** 
 * Включение или отключение вывода ошибок на сайте
 * @param bool $flag (true - вкл | false - откл)
 * */

function phpError($flag = false)
{
	if ($flag === false) {
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		error_reporting(E_ALL);
	}
}

/* Формирование namespace */
function creat_namespace($namespace, $class)
{
	$result = $namespace . $class;
	$result = str_replace('/', '\\', $result);
	return $result;
}

/**
 * Подключение файлов
 * @param string|array $include ссылка или массив ссылок для подключения
 * @return void 
 */
function includeFiles($include)
{
	// Подключаем файлы по умолчанию
	if (is_array($include)) {
		foreach ($include as $result) {
			if (!is_array($result)) {
				if (!is_dir($result)) {
					@include_once($result);
				}
			} else {
				includeFiles($result);
			}
		}
	} else {
		if (!is_dir($result)) {
			@include_once($result);
		}
	}
}

/* Автозагрузчик классов */
function autoloadClasses($class_name)
{
	$class_name = str_replace('\\', '/', $class_name);
	if (defined('layout')) {
		//	$class_name = str_replace('layout_name', layout, $class_name);
	}
	@include_once $class_name . '.php';
}
//spl_autoload_register('autoloadClasses');

/**
 * Запускает нужный метод
 * @param string $class имя класса
 * @param string $method имя метода
 * @param bool|string $method_name первый параметр
 * @param bool|string $data второй параметр
 * @param bool $return вернуть результат?
 * @return void|bool Вернет (true | false) если  $return = true
 */
/*
function start_method($class, $method, $param_1 = false, $param_2 = false, $return = false)
{
	if (check_ClassAndMethod($class, $method)) {
		//$class = '\\' . $class;
		if ($param_1 && $param_2) {
			if ($return) {
				return ($class::$method($param_1, $param_2));
			} else {
				$class::$method($param_1, $param_2);
			}
		} else if ($param_1 && !$param_2) {
			if ($return) {
				return ($class::$method($param_1));
			} else {
				$class::$method($param_1);
			}
		} else if (!$param_1 && $param_2) {
			if ($return) {
				return ($class::$method($param_2));
			} else {
				$class::$method($param_2);
			}
		} else {
			if ($return) {
				return ($class::$method());
			} else {
				$class::$method();
			}
		}
	}
}

/**
 * Запускает нужное дополнение
 * @param string $add_name Имя дополнения
 * @param mixed $data Данные для передачи дополнению
 * @return mixed Вернет результат работы вызываемой функции 
 */
function add($add_name, $data = null)
{
	if (defined('add')) {
		if (isset(add[$add_name])) {
			$add = add[$add_name]['Controller'];
			$link = $add['link'];
			$method = $add['method'];
			$class = $add['class'];
			$method_name = $add['method_name'];
			if (!\system\functions\sub::include($link)) {
				if (!@include_once($link)) {
					new Ex(ExDetailsText::include($link, 'add => ' . $add_name . ' => Controller'), 'view');
				} else {
					return	$class::$method(['return' => [$method_name => $data]]);
				}
			}
		}
	}
}
