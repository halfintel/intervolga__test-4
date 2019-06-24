<?php
/*
	главный контроллер

	инструкция запуска:
		создать БД и записать её доступы в /config/index.php
		создать таблицу countries со столбцами:
			countryName			 - varchar	 - 32	 - utf8_general_ci	 - primary
			numberOfPeopleCount	 - bigint	 - 32
*/

//проверки наличия файлов
if ( 
	file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/index.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/controllers/index.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/css/index.php' )
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/images/index.php' )
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/js/index.php' )
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/models/index.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/index.php' ) 
){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/models/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/views/index.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/index.php';
	
} else {
	header('HTTP/1.0 404 Not Found');
	header('Content-Type: application/json');
	echo json_encode(array(
		'status' => 'error',
		'code' => '404',
		'error' => 'File Not Found',
		'folder' => 'main'
	));
	die;
}

//разбор url
$url = ( isset($_GET['path']) ) ? $_GET['path'] : '';
$url = rtrim($url, '/');
$path = explode('/', $url);

//подключение нужной страницы
if( $path[0] === 'addcountry' ) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/addCountryController.php';
	
} else if ( $path[0] === 'api' ){
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/apiController.php';
	
} else {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/tableController.php';
}
