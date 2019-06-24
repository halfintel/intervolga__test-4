<?php
/*
	модель страницы "таблица стран"
*/

//обращается к api и получает массив [ [code], [message], [ [country, numberOfPeople], [country, numberOfPeople], ... ] ]
$url = 'http://test-4.volga/api/';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$tableArray = curl_exec($ch);
$tableArray = json_decode($tableArray, true);
curl_close($ch);
