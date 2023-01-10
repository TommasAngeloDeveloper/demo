<?php

namespace view;

class data
{
	private const name = 'a_login'; // Имя файла стилей и скриптов
	/**************************************************************************/
	/* Список папок */
	/**************************************************************************/
	private const folders = [
		'apps' => 'apps/',
		'data' => 'data/',
		'res' => 'res/', // Папка с js, css, img
		'img' => 'img/',
		'style' => 'style/',
		'css' => 'css/', // Папка с css
		'css_min' => 'css_min/', // Папка с css_min
		'scss' => 'scss/', // Папка с scss
		'js' => 'js/', // Папка с js
	];
	/**************************************************************************/
	/* Списки файлов */
	/**************************************************************************/
	private const files = 	[
		'css' =>  self::name . '.css', // Имя файла cms стилей
		'css_min' =>  self::name . '.min.css', // Имя файла cms стилей
		'css_m' => 'm_' . self::name . '.css', // Имя файла cms стилей
		'css_min_m' => 'm_' . self::name . '.min.css', // Имя файла cms стилей
		'js' => self::name . '.js',
	];

	/**************************************************************************/
	/* Пути к папкам */
	/**************************************************************************/
	private  $path = [
		'apps' => self::folders['system'] . self::folders['apps'],
		'data' => self::folders['system'] . self::folders['data'],
		'res' => self::folders['system'] . self::folders['res'],
	];

	/**************************************************************************/
	/* Ссылки для подключения файлов */
	/**************************************************************************/
	private	$link = [
		'css' => [
			self::name  => [
				'css' =>   self::folders['res'] . self::folders['style'] . self::folders['css'] . self::files['css'],  // Файл с css
				'css_min' =>   self::folders['res'] . self::folders['style'] . self::folders['css_min'] . self::files['css_min'],  // Файл с min.css
				'css_m' =>  self::folders['res'] . self::folders['style'] . self::folders['css'] . self::files['css_m'],  // Файл с css mobile
				'css_min_m' =>  self::folders['res'] . self::folders['style'] . self::folders['css_min'] . self::files['css_min_m'],  // Файл с min.css mobile
			]
		],
		'js' => [
			self::name  => [
				//	self::name => self::folders['res'] . self::folders['js'] . self::files['js'],
			]

		], // Файл с функциями js
	];
	use \traits\BaseMethods;
}
