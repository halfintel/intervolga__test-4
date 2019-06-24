<?php
/*
	глобальные настройки
*/

//настройки БД
global $db_config;
$db_config['db_server'] = "localhost";		// локалхост
$db_config['db_user'] = "root";			// имя пользователя
$db_config['db_password'] = "";			// пароль если существует
$db_config['db_name'] = "volga_test4";		// база данных

//настройки шаблонов (паттернов) для полей форм
global $regexp_config;
$regexp_config['regexpCountry'] = '/^([a-zA-Zа-яА-ЯЁё]{1,1})([a-zA-Zа-яА-ЯЁё0-9\s\'\-]{0,31})$/u';	//шаблон проверки страны
$regexp_config['regexpCountryHtml'] = '^([a-zA-Zа-яА-ЯЁё]{1,1})([a-zA-Zа-яА-ЯЁё0-9\s\'\-]{0,31})$';	//шаблон проверки страны для html

$regexp_config['regexpNumberOfPeople'] = '/^[0-9]{1,13}$/';					//шаблон проверки населения страны
$regexp_config['regexpNumberOfPeopleHtml'] = '^[0-9]{1,13}$';				//шаблон проверки населения страны для html