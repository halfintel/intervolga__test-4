<?php

//проверки наличия файлов
if ( 
	file_exists( $_SERVER['DOCUMENT_ROOT'] . '/models/addCountryModel.php' )
	&& file_exists( $_SERVER['DOCUMENT_ROOT'] . '/models/apiModel.php' ) 
	&&  file_exists( $_SERVER['DOCUMENT_ROOT'] . '/models/tableModel.php' ) 
){
} else {
	header('HTTP/1.0 404 Not Found');
	header('Content-Type: application/json');
	echo json_encode(array(
		'status' => 'error',
		'code' => '404',
		'error' => 'File Not Found',
		'folder' => 'models'
	));
	die;
}
