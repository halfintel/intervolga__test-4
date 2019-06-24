<?php

//проверки наличия файлов
if ( 
	file_exists( $_SERVER['DOCUMENT_ROOT'] . '/css/bootstrap-grid.min.css' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/css/reset.css' ) 
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/css/style.css' ) 
){
} else {
	header('HTTP/1.0 404 Not Found');
	header('Content-Type: application/json');
	echo json_encode(array(
		'status' => 'error',
		'code' => '404',
		'error' => 'File Not Found',
		'folder' => 'css'
	));
	die;
}
