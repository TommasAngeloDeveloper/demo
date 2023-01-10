<?php

namespace view;

class Controller
{
	use \traits\Singleton_Controller;

	private static function html($data)
	{
		$link = 'html.php';
		if (!@include_once($link)) {
			//	new \RouteException(\ExceptionsText::include($link . $link . $link . $link . $link . $link . $link . $link . $link . $link . $link), 'view', 12);
		} else {
			return html::return('html');
		}
	}
}
