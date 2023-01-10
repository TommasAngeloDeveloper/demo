<?php

namespace system\functions;

/****************************************************************************/
/* Работа с Массивами */
/****************************************************************************/
class Arrays
{
	/* Проверяет асоциотивный ли масив */
	/* (Если есть хотя бы один строковый ключ, $array будет рассматриваться как ассоциативный массив) */
	public static	function check_assoc($array)
	{
		return count(array_filter(array_keys($array), 'is_string')) > 0;
	}

	/* рекурсия массива */
	public static function recursive($key, $result, $value)
	{
		foreach ($result as $key_2 => $result_2) {
			if (is_array($result_2)) {
				self::recursive($key, $result_2, $value);
			} else {
				$return[$key_2] = $value . $result_2;
			}
		}
		return $return;
	}
	/**
	 * Объединяет (склеивает) элементы массива в строку
	 * @param array $array Массив объединяемых строк
	 * @param int $separator Разделитель
	 * @param int $separator_start Разделитель в начале
	 * @param int $separator_end Разделитель в конце
	 * @return string|false Вернет строку или false
	 *  */
	public static function implode($array, $separator = ' ', $separator_start = '', $separator_end = '')
	{
		if (!is_array($array)) {
			$return = false;
		} else {
			if (!is_string($separator)) {
				$separator = '';
			}
			if (!is_string($separator_start)) {
				$separator_start = '';
			}
			if (!is_string($separator_end)) {
				$separator_end = '';
			}
			$return = $separator_start . implode($separator, $array) . $separator_end;
		}
		return $return;
	}
	/**
	 * Обрезает массив
	 * @param array $array Входной массив
	 * @param int $offset С какого элемента массива начинать (отрицательный - последователность с конца)
	 * @param int $lengh Количество элементов массива, которые оставляем
	 * @param bool $preserve_keys Сбросить ключи массива? (Строковые ключи сохраняются)
	 * @return array|false Вернет обрезанный массив или false
	 *  */
	public static function array_slice($array, $offset, $lengh, $preserve_keys = false)
	{
		if (!is_array($array) || !is_int($offset) || !is_int($lengh)) {
			return false;
		} else {
			if (!is_bool($preserve_keys)) {
				$preserve_keys = false;
			}
			$return = array_slice($array, $offset, $lengh, $preserve_keys = false);
			return $return;
		}
	}
	/**
	 * Проверяет, присутствует ли в массиве значение
	 * @param array $array Массив в котором ищем
	 * @param string $value Значение которое ищем
	 * @return bool Вернет true|false
	 *  */
	public static function in_array($array, $value)
	{
		if (is_array($array) && !is_array($value)) {
			return in_array($value, $array);
		}
	}
}
