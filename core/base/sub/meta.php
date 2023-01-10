<?php

namespace core\base;

use ta_Str;

class meta
{
	function __construct($data, $sample = [
		'mobile' => false,
		'title' => [
			'value' => null
		],
		'title_prefix' => [
			'status' => false,
			'value' => null
		],
		'description' => null,
		'keywords' => null,
		'favico' => null,
		'css' => [],
		'js' => [],
	])
	{
		if (is_array($data)) {
			foreach ($data as $key => $result) {
				if (array_key_exists($key, $data)) {
					if (!empty($result)) {
						$data[$key] = $result;
					}
				}
			}
		}
		if (isset($settings['mobile'])) {

			$data['mobile'] = $settings['mobile'];
		}
		self::create_html($data);
	}
	private	static function create_html($data)
	{
?>

		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<?php
			if ($data['favico'] === '') {
			?>
				<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEQAAAAAAAAARAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARAAAAAAAAABEAAAAAAAAAEREQAAAAAAABEREAAAARAAAAEQAAABEAAAARAAAAEREREREAAAABEREREAAAAAAAAAAAAAAAAAAAAAAAD+fwAA/D8AAPgfAAD4HwAA/D8AAPw/AAD4DwAA+AcAAOADAADAAQAAgAEAAIABAACAAQAAwAMAAOAHAADwDwAA" rel="icon" type="image/x-icon" />
			<?php
			}
			?>

			<?php
			/* 

<meta name="description" lang="ru" content="<?php if (defined('page_description'))  echo page_description  ?>">
<meta name="keywords" lang="ru" content="<?php if (defined('page_keywords'))  echo page_keywords ?>">

<meta name="Author" content="Tommas Angelo">
<meta name="Copyright" content="Tommas Angelo">
<meta name="Address" content="TommasAngeloDeveloper@gmail.com">

<!-- Favicon -->
<!-- 
		<link rel="apple-touch-icon" sizes="57x57" href="<?= $favicon_path ?>/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?= $favicon_path ?>/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?= $favicon_path ?>/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?= $favicon_path ?>/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?= $favicon_path ?>/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?= $favicon_path ?>/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?= $favicon_path ?>/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?= $favicon_path ?>/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?= $favicon_path ?>/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192" href="<?= $favicon_path ?>/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= $favicon_path ?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?= $favicon_path ?>/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= $favicon_path ?>/favicon-16x16.png">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?= $favicon_path ?>/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">


	<meta property="og:title" content="«Вектор» образовательно-технический центр профессиональной подготовки">
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.vektor71.ru/">
	<meta property="fb:app_id" content="AdmiN">
	<meta property="og:site_name" content=" Учебный центр Вектор">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content=" Учебный центр Вектор">
*/
			?>
			<title>
				<?
				$data['title']['value'] = \system\functions\str::trim($data['title']['value']);
				if ($data['title']['value'] != '' && is_string($data['title']['value'])) {
					echo  $data['title']['value'];
				} else {
					echo 'no title';
				}
				$data['title_prefix']['value'] = \system\functions\str::trim($data['title_prefix']['value']);
				if ($data['title_prefix']['value'] != '' && is_string($data['title_prefix']['value'])) {
					echo ' | ' . $data['title_prefix']['value'];
				} ?>
			</title>
			<?php
			if ($data['css'] != '' && is_array($data['css'])) {
				foreach ($data['css'] as $result) {
					if (file_exists($result[defaults['key_css']])) {
			?>
						<link href="/<?= $result[defaults['key_css']] ?>" rel="stylesheet" type="text/css">
						<?php
					}
					if ($data['mobile'] === true) {
						if (file_exists($result[defaults['key_css_m']])) {
							if (isset($result[defaults['key_css_m']]) && !empty($result[defaults['key_css_m']]) && file_exists($result[defaults['key_css_m']])) {
						?>
								<link href="/<?= $result[defaults['key_css_m']] ?>" rel="stylesheet" type="text/css">
				<?php
							}
						}
					}
				}
				?>
				<?php
			}
			unset($result);
			if ($data['js'] !== '') {
				foreach ($data['js'] as $link) {
					if (file_exists($link)) { ?>
						<script src="/<?= $link ?>"></script>
			<?php
					}
				}
			}
			unset($link);
			?>

		</head>
<?
	}
}
