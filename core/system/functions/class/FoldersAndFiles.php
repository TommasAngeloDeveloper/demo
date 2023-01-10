<?php

/********************************************************************/
/* Работа с папками + файлами */
/********************************************************************/
class  FoldersAndFiles
{
	/********************************************************************/
	/* папки + файлы */
	/********************************************************************/

	/** 
	 *  Вернёт массив имен файлов и папок из указанной директории
	 * (содержащиеся директории будут проигнорированы)
	 * @param string $dir  путь к директории
	 * @param bool $file  добавить файлы (true / false)
	 * @return array|false Вернет массив имен папок (файлов) или false
	 * */
	public static	function folder_ListFolders($dir, $file = false)
	{
		if (file_exists($dir)) {
			$result = array();
			$cdir = scandir($dir);
			foreach ($cdir as $value) {
				// если это "не точки" 
				if (!in_array($value, array(".", ".."))) {
					if ($file === false) {
						if (is_dir($dir . $value)) {
							$result[] = $value;
						}
					} else {
						$result[] = $value;
					}
				}
			}
			return $result;
		} else {
			return false;
		}
	}
	/* Получаем полный путь ко всем папкам в директории и имена файлов в них */
	public static function path_and_name($dir, $recursive = true)
	{
		/**
		 * @param  string $dir             Путь до папки (на конце со слэшем или без).
		 * @param  bool   $recursive       Включить вложенные папки или нет?
		 */
		if (!is_dir($dir))
			return array();
		$files = array();
		$dir = rtrim($dir, '/\\'); // удалим слэш на конце
		foreach (glob("$dir/{,.}[!.,!..]*", GLOB_BRACE) as $file) {
			if (is_dir($file)) {
				if ($recursive === true) {
					$files = array_merge($files, call_user_func(__METHOD__, $file, $recursive));
				}
			} else {
				$files[] = $file;
			}
		}
		return $files;
	}

	// Переименование файла или папки
	public static function rename($path, $old_name, $new_name)
	{
		if (file_exists($path  . $old_name) && !file_exists($path . $new_name)) {
			echo $path . $new_name;
		}
	}

	// Проверяет искомое имя файла или папки в директории
	public static function check_dir($dir, $checkName)
	{
		$array_FilesAndFolder = FoldersAndFiles::folder_ListFolders($dir);
		if (in_array($checkName, $array_FilesAndFolder)) {
			return true;
		} else {
			return false;
		}
	}
	// Удалить директорию со всем содержимым
	function remove_dir($dir)
	{
		if ($objs = glob($dir . '/*')) {
			foreach ($objs as $obj) {
				is_dir($obj) ? FoldersAndFiles::remove_dir($obj) : unlink($obj);
			}
		}
		rmdir($dir);
	}
	// Удалить только содержимое директории
	public static function clear_dir($dir, $rmdir = false)
	{
		if ($objs = glob($dir . '/*')) {
			foreach ($objs as $obj) {
				is_dir($obj) ? FoldersAndFiles::clear_dir($obj, true) : unlink($obj);
			}
		}
		if ($rmdir) {
			rmdir($dir);
		}
	}

	// Копирует папку со всем содержимым
	public static function copy_dir($dir_copy, $dir_new)
	{
		$dir = opendir($dir_copy);

		if (!is_dir($dir_new)) {
			mkdir($dir_new, 0777, true);
		}

		while (false !== ($file = readdir($dir))) {
			if ($file != '.' && $file != '..') {
				if (is_dir($dir_copy . '/' . $file)) {
					FoldersAndFiles::copy_dir($dir_copy . '/' . $file, $dir_new . '/' . $file);
				} else {
					copy($dir_copy . '/' . $file, $dir_new . '/' . $file);
				}
			}
		}

		closedir($dir);
	}
	/********************************************************************/
	/* папки */
	/********************************************************************/

	// Создание каталога
	public static function add_Catalog($catalog)
	{

		if (!is_array($catalog)) {
			$catalogs = [$catalog];
		} else {
			$catalogs = $catalog;
		}
		foreach ($catalogs as $new_catalog) {

			if ($new_catalog !== '') {

				$new_catalog = $_SERVER['DOCUMENT_ROOT'] . '/' . $new_catalog;
				if (!file_exists($new_catalog)) {

					if (mkdir($new_catalog, 0777, True)) {
						$result = true;
					} else {
						$result = false;
						break;
					}
				} else {
					$result = true;
				}
			} else {
				$result = false;
				break;
			}
		}
		return $result;
	}

	/*  Вернёт многомерный массив, содержащий имена файлов из указанной директории
	  (содержащиеся директории будут проигнорированы)
	  + дополнительные сведения о каждом файле (в частности размер) */

	public static function folder_ListFoldersAndInfo($dir)
	{
		$result = array();
		$cdir = scandir($dir);
		$i = 0;
		foreach ($cdir as $value) {
			// если это "не точки" и не директория
			if (!in_array($value, array(".", ".."))) {
				$result[$i]['name'] = $value;
				$result[$i]['size'] = filesize($dir . DIRECTORY_SEPARATOR . $value);
				$i++;
			}
		}

		return $result;
	}
	/********************************************************************/
	/* файлы */
	/********************************************************************/

	// Перенос файлов
	public static function transferFiles($file_name, $old_folder, $new_folder)
	{
		//echo $file_name . ' -- ' . $old_folder . ' -- ' . $new_folder;
		//	die;
		// Проверяем существование файла
		// Если файл существует, то переносим с удалением
		if (FoldersAndFiles::check_file($old_folder . $file_name)) {
			rename($old_folder . $file_name, $new_folder . $file_name);
		}
	}

	// Имена всех файлов в папке
	// @param $array - true/false * Вернуть массив или первый попавшийся файл
	public static function file_allFileName($dir, $array = true)
	{
		$new_array = [];
		if (is_dir($dir)) {
			$array_all = scandir($dir);
			$array_all = array_diff($array_all, [".", ".."]);
			foreach ($array_all as $result) {
				if (!is_dir($dir . $result)) {
					if ($array == true) {
						array_push($new_array, $result);
					} else {
						$new_array = $result;
						break;
					}
				}
			}

			return $new_array;
		}
	}

	// Проверяем наличие файла
	public static function check_file($link)
	{
		if (isset($link) && $link !== '') {
			if (file_exists($link) && !is_dir($link)) {
				return true;
			}
		}
		return false;
	}
	/* Имя и расширение файла */
	public static function file_Info($path, $param = '')
	{
		$path_parts = pathinfo($path);
		if ($param == 'filename') { // Имя файла без расширения
			$result =  $path_parts['filename'];
		} elseif ($param == 'extension') { // Расширение файла
			$result =  $path_parts['extension'];
		} elseif ($param == 'dirname') { // Путь к файлу
			$result =  $path_parts['dirname'];
		} else { // Имя файла + расширение
			$result =  $path_parts['basename'];
		}
		return $result;
	}
	/* Создание файла с контентом внутри */
	public static function create_File_php($link, $content)
	{
		if (file_put_contents($link, $content)) {
			return true;
		} else {
			return false;
		};
	}
	/*	Проверка размера файла  */
	public static function file_ValidateSize($file_size, $max_size, $key)
	{
		if ($key == 'kb' || $key == 'KB') {
			$file_size = $file_size / (1024);
		} elseif (
			$key == 'mb' || $key == 'MB'
		) {
			$file_size = $file_size / (1024 * 1024);
		} elseif ($key == 'gb' || $key == 'GB') {
			$file_size = $file_size / (1024 * 1024 * 1024);
		} elseif ($key == 'tb' || $key == 'TB') {
			$file_size = $file_size / (1024 * 1024 * 1024 * 1024);
		}
		if ($file_size > $max_size) {
			return false;
		} else {
			return true;
		}
	}


	/*	Расчет размера файла */
	public static function file_GetSize($file_size)
	{
		if (
			$file_size < 1000 * 1024
		) {
			return number_format($file_size / 1024, 2) . " KB";
		} elseif ($file_size < 1000 * 1048576) {
			return number_format($file_size / 1048576, 2) . " MB";
		} elseif ($file_size < 1000 * 1073741824) {
			return number_format($file_size / 1073741824, 2) . " GB";
		} else {
			return number_format($file_size / 1099511627776, 2) . " TB";
		}
	}

	/*
	  Вернёт массив, содержащий имена файлов из указанной директории
	  (содержащиеся директории будут проигнорированы)
	 */
	public static	function file_ListNameFiles($dir, $extension = true)
	{
		$result = array();
		$cdir = scandir($dir);
		foreach ($cdir as $value) {
			// если это "не точки" и не директория
			if (
				!in_array($value, array(".", ".."))
				&& !is_dir($dir . DIRECTORY_SEPARATOR . $value)
			) {
				if ($extension) {
					$result[] = $value;
				} else {
					$result[] = self::file_Info($dir . $value, 'filename');
				}
			}
		}

		return $result;
	}


	/*
	  Вернёт многомерный массив, содержащий имена файлов из указанной директории
	  (содержащиеся директории будут проигнорированы)
	  + дополнительные сведения о каждом файле (в частности размер)
	 */
	public static function file_ListFilesAndInfo($dir)
	{
		$result = array();
		$cdir = scandir($dir);
		$i = 0;
		foreach ($cdir as $value) {
			// если это "не точки" и не директория
			if (
				!in_array($value, array(".", ".."))
				&& !is_dir($dir . DIRECTORY_SEPARATOR . $value)
			) {

				$result[$i]['name'] = $value;
				$result[$i]['size'] = filesize($dir . DIRECTORY_SEPARATOR . $value);
				$i++;
			}
		}

		return $result;
	}
}
