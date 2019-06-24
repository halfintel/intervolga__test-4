<?php

//проверки наличия файлов
if ( 
	file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/addCountryView.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/apiView.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/footerView.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/headerView.php' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/views/tableView.php' ) 
){
} else {
	header('HTTP/1.0 404 Not Found');
	header('Content-Type: application/json');
	echo json_encode(array(
		'status' => 'error',
		'code' => '404',
		'error' => 'File Not Found',
		'folder' => 'views'
	));
	die;
}
