<?php

namespace base;

class regexp
{
	private  $regexp = [
		// Имя для регистрации RUS/ENG
		'name' => '/(^[a-zA-Z][a-zA-Z]{0,28}[a-zA-Z]$)|(^[а-яА-Я][а-яА-Я]{0,28}[а-яА-Я]$)/u',
		// Логин ENG
		'login' => '/^[a-zA-Z][a-zA-Z0-9-_]{0,28}[a-zA-Z0-9]$/u',
		// Пароль PASSWORD
		'password' => '/^[a-zA-Z0-9-_]{1,1}[a-zA-Z0-9-_]{6,18}[a-zA-Z0-9-_]{1,1}$/',
		// Почта
		'mail' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{0,50}[0-9A-Za-z]?)|([0-9А-Яа-я]{1}[-0-9А-я\.]{0,50}[0-9А-Яа-я]?))@([-A-Za-z]{1,}\.){1,}[-A-Za-z]{2,})$/u',
	];
	use \traits\BaseMethods;
}
