<?php

namespace system\functions;

/********************************************************************/
/* Работа с Базами Данных */
/********************************************************************/
class DataBase
{
	// Функция подключения к базе данных
	public static function connect_db($user_name = 'root', $password = '', $db_name, $servername = 'localhost')
	{
		$connect = @new \mysqli($servername, $user_name, $password, $db_name);
		if ($connect->connect_error) {
			return false;
		} else {
			return $connect;
		}
	}

	// Функция подключения к Хостингу с Базами данных
	public static function connect_host($user_name = 'root', $password = '', $servername = 'localhost')
	{
		$connect = @new \mysqli($servername, $user_name, $password);
		if ($connect->connect_error) {
			return false;
		} else {
			return $connect;
		}
	}

	// Функция поиска имени базы данных
	public static function checkDataBaseName($db_name, $connect_host)
	{
		$sql = mysqli_query($connect_host, 'SHOW DATABASES');
		foreach ($sql as $result) {
			$array_Name_db[] = $result["Database"];
		};

		if (in_array($db_name, $array_Name_db)) {
			return true;
		} else {
			return false;
		}
	}

	// Функция создания новой Базы Данных
	public static function addDataBase($db_name, $connect_host)
	{
		$sql = "CREATE DATABASE `$db_name`";
		if ($connect_host->query($sql) === TRUE) {
			return true;
		} else {
			return false;
		}
	}
}
