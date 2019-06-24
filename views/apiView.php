<?php
/*
	представление api
*/

switch ($result['code']) {
	case 200:
		header('HTTP/1.0 200 OK');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
		
	case 201:
		header('HTTP/1.0 201 Created');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
		
	case 400:
		header('HTTP/1.0 400 Bad Request');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
		
	case 409:
		header('HTTP/1.0 409 Conflict');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
		
	case 500:
		header('HTTP/1.0 500 Internal Server Error');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
		
	default:
		$result['code'] = 500;
		$result['message'] = 'Unknown error';
		header('HTTP/1.0 500 Internal Server Error');
		header('Content-Type: application/json');
		echo json_encode( $result );
		break;
}
