<?php

namespace system\functions;

/********************************************************************/
/* Работа с Таблицами */
/********************************************************************/
class TABLE
{
	// Создание таблицы
	public static function addTable($connect, $table_name)
	{
		$sql = "CREATE TABLE `$table_name` (
					id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY
					)";
		if ($connect->query($sql) === TRUE) {
			return true;
		} else {
			return false;
		}
	}
	public static function deletTable($connect, $table_name)
	{

		$sql = "DROP TABLE `$table_name`";
		if ($connect->query($sql) === TRUE) {
			return true;
		} else {
			return false;
		}

		/*
		$sql = "DROP TABLE `$table_name`";
		if (mysqli_query($connect, $sql)) {
			return true;
		} else {
			return false;
		}
		*/
	}
	// Поиск таблицы по имени 
	public static function tableNameSearch($db_name, $connect, $table_name)
	{
		$all_tables = mysqli_query(
			$connect,
			"SHOW TABLES FROM `$db_name`"
		);
		$tables = mysqli_fetch_all($all_tables);
		foreach ($tables as $table) {
			if ($table[0] == $table_name) {
				return true;
				break;
			}
		};
		return false;
	}

	// Поиск всех имен таблиц в базе 
	public static function tableNameAll($db_name, $connect)
	{
		$all_tables = mysqli_query(
			$connect,
			"SHOW TABLES FROM `$db_name`"
		);
		$tables = mysqli_fetch_all($all_tables);
		foreach ($tables as $table) {
			$table_names[] = $table[0];
		};
		return $table_names;
	}

	// Прибавляем к имени таблице в конце ++i 
	public static function tableNameHelper($db_name, $connect, $table_name, $i = '001')
	{
		$regexp = '/^[0]{1,1}[0]{0,2}[1]{1,1}$/';
		if (!preg_match($regexp, $i)) {
			return false;
			exit;
		} else {
			$table_names = $table_name . '_' . $i;
			$all_tables = mysqli_query(
				$connect,
				"SHOW TABLES FROM `$db_name"
			);
			$tables = mysqli_fetch_all($all_tables);
			foreach ($tables as $table) {
				while ($table[0] == $table_names) {
					++$table_names . PHP_EOL;
				};
			};
			return $table_names;
		}
	}

	// Получаем список всех имен колонок существующей таблицы
	public static function listsAllColums($connect, $db_name, $table_name)
	{
		$allColums_now = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='$db_name'  AND `TABLE_NAME`='$table_name';";

		$allColums_now = $connect->query($allColums_now);
		if ($allColums_now) {
			//Получаем имена всех существующих колонок в таблице
			foreach ($allColums_now as $columName_now) {
				// Записываем их в массив
				$allColumsName_now[] = $columName_now['COLUMN_NAME'];
			}
			return $allColumsName_now;
		} else {
			return false;
		}
	}
}
