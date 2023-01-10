<?php

namespace admin;

class html
{
	private static $settings;
	function __construct($settings)
	{
		self::$settings = $settings;
		/* view */

		self::html();
	}
	private static function html()
	{

		/* meta */
		$link = self::$settings['html']['meta']['Controller']['link'];
		$include = \system\functions\sub::include($link);
		if (isset($include['error'])) {
			new \Ex($include['error']);
		} else {
			$class = self::$settings['html']['meta']['Controller']['class'];
			$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class);
			if (isset($check_ClassAndMethod['error'])) {
				new \Ex($check_ClassAndMethod['error']);
			} else {
				$class_meta = $class;
			}
		}
		/* view */
		$class = self::$settings['html']['view']['class'];
		$check_ClassAndMethod = \system\functions\sub::check_ClassAndMethod($class);
		if (isset($check_ClassAndMethod['error'])) {
			new \Ex($check_ClassAndMethod['error']);
		} else {
			$class_view = $class;
		}

?>
		<!DOCTYPE html>
		<html lang="ru">

		<head>
			<?php
			/* meta */
			new $class_meta(self::$settings['html']['meta']['data']);

			?>
		</head>

		<body>
			<?php

			add('pop_up_msg_systems');

			/* view */
			$class_view::return(['return' => ['html' => null]]);
			//	$class_view::return('html', self::$settings['html']['view']['data']);

			?>
		</body>

		</html>
<?php

	}
}
?>