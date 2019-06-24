<?php

//проверки наличия файлов
if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/images/sect2__picture.png' ) ){
} else {
	header('HTTP/1.0 404 Not Found');
	header('Content-Type: application/json');
	echo json_encode(array(
		'status' => 'error',
		'code' => '404',
		'error' => 'File Not Found',
		'folder' => 'images'
	));
	die;
}
