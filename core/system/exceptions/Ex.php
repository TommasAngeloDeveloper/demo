<?php
$root = 'core/system/exceptions/';
$include = [
	[
		'path' => 'data/',
		'file' => 'ExDetailsText'
	],
	[
		'path' => 'data/',
		'file' => 'ExMsgCodes'
	],
];
foreach ($include as $link) {
	$link['link'] = $root . $link['path'] . $link['file'] . '.php';
	if (!include_once($link['link'])) {
		throw new Exception('Сайт временно не доступен. Error |2| ' . $link['file']);
	}
}
/** 
 * Exception *
 */
class Ex extends \Exception
{
	private const css = [
		'exception' => [
			'css' => 'core/system/exceptions/style/css/exceptions.css',
			'css_min' => 'core/system/exceptions/style/css_min/exceptions.min.css',
			'css_m' => 'core/system/exceptions/style/css/m_exceptions.css',
			'css_min_m' => 'core/system/exceptions/style/css_min/m_exceptions.min.css',
		]
	];
	private static $data;
	private static $msg;
	private static $details;
	/** 
	 * Включение или отключение вывода ошибок на сайте 
	 * 
	 * @param string $details детальное описание ошибки
	 * @param string|array $type тип обработки исключения
	 * - page - выведит отдельную страницу с ошибкой и завершит работу скрипта
	 * - view - сформирует вид страницы с ошибкой
	 * - log - запишет в лог событие
	 * - log_error - запишет в лог ошибок
	 * @param int|string $code  код текста или свой текст
	 * - 0 => 'Что то пошло не так'
	 * - 1 =>  'Сайт в разработке'
	 * - 2 => 'Сайт временно недоступен'
	 * - 3 => 'Сайт на техническом обслуживании &#128679;'
	 * - 11 =>  'Страница в разработке'
	 * - 12 => 'Страница временно недоступна'
	 * - 13 => 'Страница на техническом обслуживании &#128679;'
	 * - Свое сообщение
	 */
	public function __construct($details, $type = '', $code = 12)
	{
		if ($type == '') {
			$type = 'page';
		}
		if (!is_array($type)) {
			$type = [$type];
		}
		$msg =  ExMsgCodes::return($code);
		//print_array_1($details);
		//parent::__construct($details);
		self::$data = [
			'details' => $details,
			'file' => $this->getFile(),
			'line' => $this->getLine(),
			'code' => $this->getCode(),
			'date' => date('d.m.Y'),
			'time' => date('H:i:s'),
		];
		if (defined('editor') && editor === true) {
			self::$details = self::$data;
			\system\functions\sub::transfer_css(self::css);
		} else {
			self::$details = false;
		}

		self::$msg = $msg;
		$class = get_class();
		if (is_array($type) || empty($type)) {
			foreach ($type as $method) {
				if ($method === 'page') {
					continue;
				} else {
					if (method_exists($class, $method)) {
						self::$method();
					}
				}
			}
		} else {
			if (method_exists($class, $type)) {
				self::$type();
			}
		}
		if (in_array('page', $type)) {
			self::page();
		}
	}

	private static function log()
	{
	}
	private static function log_error()
	{
	}
	private static function page()
	{
		self::view();
		die;
	}
	private static function view()
	{
		@include_once('views/view.php');
		main_Exception::main(self::css['exception'], self::$msg, self::$details);
	}
}
