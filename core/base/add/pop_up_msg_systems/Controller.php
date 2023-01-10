<?php

namespace base\add\pop_up_msg_systems;

if (!isset($_SESSION['msg']['true']) || !is_array($_SESSION['msg']['true'])) {
	$_SESSION['msg']['true'] = [];
}
if (!isset($_SESSION['msg']['false']) || !is_array($_SESSION['msg']['false'])) {
	$_SESSION['msg']['false'] = [];
}
if (!isset($_SESSION['msg']['warning']) || !is_array($_SESSION['msg']['warning'])) {
	$_SESSION['msg']['warning'] = [];
}
class Controller
{
	use \traits\Singleton_Controller;

	private static function html($data = null)
	{
		$link = self::$_instance->data['link']['html'];
		$include = \system\functions\sub::include($link);
		if (isset($include['error'])) {
			new \Ex($include['error']);
		} else {
			$class = self::$_instance->namespace  . '_html';
			$method = 'return';
			$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class, $method);
			if (isset($check_ClassAndMethod['error'])) {
				new \Ex($check_ClassAndMethod['error']);
			} else {
				$class::$method('html', $data);
			}
		}
	}
}
