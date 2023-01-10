<?php

namespace base;

class data
{
	private const name = 'base'; // Имя файла стилей и скриптов
	/**************************************************************************/
	/* Список папок */
	/**************************************************************************/
	private const folders = [
		'admin' => 'admin/',
		'add' => 'add/',
		'functions' => 'functions/', // Папка с функциями
		'data' => 'data/', // Папка с функциями
		'views' => 'views/',
		'plugins' => 'plugins/', // Папка с плагинами
		'layout' => 'layout/',	// Папка с шаблоном
		'res' => 'res/', // Папка с js, css, img
		'style' => 'style/',
		'sub' => 'sub/', // Папка с meta
		'css' => 'css/', // Папка с css
		'css_min' => 'css_min/', // Папка с css_min
		'scss' => 'scss/', // Папка с scss
		'js' => 'js/', // Папка с js
	];

	/**************************************************************************/
	/* Списки файлов */
	/**************************************************************************/
	private const files = 	[
		'html' => [
			'meta' => 'meta.php',
		],
		'functions' => 'functions.php', // Файл с функциями CMS
		'css' => self::name . '.css', // Имя файла cms стилей
		'css_min' => self::name . '.min.css', // Имя файла cms стилей
		'css_m' => 'm_' . self::name . '.css', // Имя файла cms стилей
		'css_min_m' => 'm_' . self::name . '.min.css', // Имя файла cms стилей
		'jQuery_v1' => 'jQuery-1.12.4.min.js', // Имя файла jQuery v1
		'jQuery_v3' => 'jQuery-3.6.0.min.js', // Имя файла jQuery v3
		'js' => 'function.js',
	];

	/**************************************************************************/
	/* Пути к папкам */
	/**************************************************************************/
	private  $path = [
		'add' => self::folders['add'],
		'admin' => self::folders['admin'],
	];

	/**************************************************************************/
	/* Ссылки для подключения файлов */
	/**************************************************************************/
	private 	$link = [
		'meta' => self::folders['sub'] . self::files['html']['meta'],
		'css' => [
			self::name => [
				'css' =>  self::folders['res'] . self::folders['style'] . self::folders['css'] . self::files['css'],  // Файл с css
				'css_min' =>   self::folders['res'] . self::folders['style'] . self::folders['css_min'] . self::files['css_min'],  // Файл с min.css
				'css_m' => self::folders['res'] . self::folders['style'] . self::folders['css'] . self::files['css_m'],  // Файл с css mobile
				'css_min_m' =>  self::folders['res'] . self::folders['style'] . self::folders['css_min'] . self::files['css_min_m'],  // Файл с min.css mobile
			]
		],
		'js' => [
			'jQuery_v1' =>	self::folders['res'] . self::folders['js'] . self::files['jQuery_v1'],
			'base_function' =>	self::folders['res'] . self::folders['js'] . self::files['js'],
		],  // Файл с функциями js
	];
	use \traits\BaseMethods;
}
