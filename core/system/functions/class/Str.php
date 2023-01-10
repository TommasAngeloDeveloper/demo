<?php

namespace system\functions;

/****************************************************************************/
/* Работа со строками */
/****************************************************************************/
class Str
{
	/**
	 * Замена одного символа на другой 
	 * @param string $text Массив в котором ищем
	 * @param string $s_old Символ который заменяем
	 * @param string $s_new Символ на который заменяем
	 * @return string Вернет замененную строку
	 *  */
	public static function editSimvol($text, $s_old, $s_new)
	{

		$text_new = str_replace($s_old, $s_new, $text);
		return $text_new;
	}
	// Транскрипция с русского на англ
	public static function transcription($s)
	{
		$s = (string) $s; // преобразуем в строковое значение
		$s = trim($s); // убираем пробелы в начале и конце строки
		//$s = str_replace(' ', '_', $s); // заменяем пробелы на нижний слеш
		$s = str::editSimvol($s, ' ', '_');
		$s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)

		$s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
		//$s = strtolower($s);
		return $s; // возвращаем результат
	}
	/* Удаляем однострочные и многострочные комментарии в PHP файлах */
	public static function delet_comennts($path_and_file)
	{
		// открываем файл
		$file = file_get_contents($path_and_file);
		// удаляем строки начинающиеся с #
		$file = preg_replace('/#.*/', '', $file);
		// удаляем строки начинающиеся с //
		$file = preg_replace('#//.*#', '', $file);
		// удаляем многострочные комментарии /* */
		$file = preg_replace('#/\*(?:[^*]*(?:\*(?!/))*)*\*/#', '', $file);
	}

	/* Раскладываем строку на массим в формате UTF-8 */
	public static function utf8str_to_arr($str)
	{
		$str = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
		return  $str;
	}

	/* Первый символ заглавный UTF-8 */
	public static function
	firstStrBig($str, $encoding = 'UTF-8')
	{

		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) .
			mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
	/* Проверка строки на разрешенные символы */
	public static function validate_username($str)
	{
		$allowed = array(".", "-", "_"); // Разрешенные символы
		if (ctype_alnum(str_replace($allowed, '', $str))) {
			return $str;
		} else {
			$str = "Invalid Username";
			return $str;
		}
	}

	/* Длина строки */
	public static function length_line($str)
	{
		mb_strlen($str);
		return $str;
	}

	/* Функция фильтра введенных данных */
	public static function filter_inputs($str)
	{
		//$data = trim($data); // Удаляет пробелы (или другие символы) из начала и конца строки
		$str = filter_var(trim($str), FILTER_SANITIZE_STRING);
		$str = stripslashes($str); // Удаляет экранирование символов, произведенное функцией
		$str = htmlentities($str); // Преобразует символы в соответствующие HTML сущности
		return $str;
	}

	/* Первый символ строки*/
	public static function firstLetter($str)
	{
		$firstLetter = mb_substr($str, 0, 1, "UTF-8"); // Получаем первый символ строки "UTF-8"
		return $firstLetter;
	}
	/* последний символ строки */
	public static function lasttLetter($str)
	{
		$firstLetter = mb_substr($str, -1, 1, "UTF-8"); // Получаем последний символ строки
		return $firstLetter;
	}
	/* Кодирование и Декодирование строк */
	public static	function encrypt_decrypt($action, $string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx';
		$secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx';
		// hash
		$key = hash('sha256', $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes 
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ($action == 'encode') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if (
			$action == 'decode'
		) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}

	/* Найти все после символа */
	public static function stringAfterCharacter($data, $character)
	{
		if (($pos = strpos($data, $character)) !== false) {
			return substr($data, $pos + 1);
		} else {
			//return false;
		}
	}

	/* Сравнение начала строки */
	public static function matchStr($param, $str)
	{
		$result = preg_match('/^(' . $param . ')/', $str);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Удаляет пробелы (или другие символы) из начала и конца строки
	 * @param string $str Обрезаемая строка
	 * @param string $characters Список символов для удаления. Просто перечислите все символы, которые вы хотите удалить
	 * - " " (ASCII 32 (0x20)), обычный пробел.
	 * - "\t" (ASCII 9 (0x09)), символ табуляции.
	 * - "\n" (ASCII 10 (0x0A)), символ перевода строки.
	 * - "\r" (ASCII 13 (0x0D)), символ возврата каретки.
	 * - "\0" (ASCII 0 (0x00)), NUL-байт.
	 * - "\v" (ASCII 11 (0x0B)), вертикальная табуляция.
	 * @return string $str Вернет обрезанную строку или нет,если $str не строкового типа
	 */
	public static function trim($str, $characters = " \n\r\t\v\x00")
	{
		if (is_string($str)) {

			return trim($str, $characters);
		} else {
			return $str;
		}
	}
}
