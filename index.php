<?php

/***************************************************************************/
/* Подключаем сессии */
/***************************************************************************/
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

header("Access-Control-Allow-Origin: *");
header('Content-Type:text/html;charset=utf-8');
setlocale(LC_ALL, 'ru_RU.utf8'); // Для корректной работы при использовании многобайтных кодировок
$die_text = 'Сайт временно не доступен';
$include = [
	'core/system/functions/functions.php',
	'core/system/exceptions/Ex.php',
	'core/system/traits/BaseMethods.php',
	'core/system/traits/Singleton.php',
];
try {
	foreach ($include as $link) {
		if (!@include($link)) {
			throw new Exception('Сайт временно не доступен. Error |1|');
		}
	}
} catch (Exception $e) {
	die($e->getMessage());
}
/***************************************************************************/
const defaults = [
	'key_css' => 'css',
	'key_css_m' => 'css_m',
];
/***************************************************************************/

/***************************************************************************/
/* Подключаем редактор (если он существует) */
/***************************************************************************/
$folder_editor = '_editor/'; // Имя папки редактора
if (file_exists($folder_editor) && is_dir($folder_editor)) {
	define('editor', true);
	// Подключаем главный Контроллер редактора
	if (file_exists($folder_editor  . 'Controller.php')) {
		include_once($folder_editor  . 'Controller.php');
	}
} else {
	define('editor', false);
}

/***************************************************************************/
/* Вызов функции включения ошибок */
/***************************************************************************/
phpError(false);
/***************************************************************************/
/* Запускаем главный котроллер */
/***************************************************************************/
$link = 'core/launch.php';
$include = \system\functions\sub::include($link);
if (isset($include['error'])) {
	new Ex($include['error']);
} else {
	$class = 'core\launch';
	$method =  'launch';
	$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
	if (isset($check_ClassAndMethod['error'])) {
		new Ex($check_ClassAndMethod['error']);
	} else {
		$settings =  $class::$method();
		if (isset($settings['error'])) {
			new Ex($settings['error'], 'page', 2);
		} elseif ($settings === null) {
			new Ex('empty settings', 'page', 2);
		} else {
			$link = $settings['html']['_html']['link'];
			$include = \system\functions\sub::include($link);
			if (isset($include['error'])) {
				new Ex($include['error'], 'page', 02);
			} else {
				$class =  $settings['html']['_html']['class'];
				$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class);
				if (isset($check_ClassAndMethod['error'])) {
					new Ex($check_ClassAndMethod['error'], 'page', 02);
				} else {
					new $class($settings);
				}
			}
		}
	}
}
