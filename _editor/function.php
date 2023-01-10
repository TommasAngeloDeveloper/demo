<?php
define('editor_shared_css', '_editor/shared/css/');
function transfer_css($list_transfer_css)
{

	foreach ($list_transfer_css as $result) {
		transferFiles($result['file_name'], editor_shared_css, $result['new_folder']);
	};
	unset($list_transfer_css);
}
function transferFiles($file_name, $old_folder, $new_folder)
{
	// Если файл существует, то переносим с удалением
	if (!empty($file_name)) {
		if (check_file($old_folder . $file_name)) {
			if (!rename($old_folder . $file_name, $new_folder . $file_name)) {
				die('error');
			}
		}
	}
}
function check_file($link)
{
	if (!empty($link)) {
		if (file_exists($link) && !is_dir($link)) {
			return true;
		}
	}
	return false;
}
