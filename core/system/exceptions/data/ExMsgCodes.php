<?php
class ExMsgCodes
{
	public static function return($code)
	{
		return self::codes($code);
	}

	private static function codes($code)
	{
		$codes = [
			0 => 'Что то пошло не так',
			1 =>  'Сайт в разработке',
			2 => 'Сайт временно недоступен',
			3 => 'Сайт на техническом обслуживании',
			10 => 'Страница не существует',
			11 =>  'Страница в разработке',
			12 => 'Страница временно недоступна',
			13 => 'Страница на техническом обслуживании',
		];
		if (isset($codes[$code])) {
			return $codes[$code];
		} else {
			return $codes[0];
		}
	}
}
