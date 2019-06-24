<?php
/*
	модель api
*/

$result = apiModel();

//разбор url и вызов роутера
function apiModel(){
	$url = ( isset($_GET['path']) ) ? $_GET['path'] : '';
	$url = rtrim($url, '/');
	$urlData = explode('/', $url);
	$method = $_SERVER['REQUEST_METHOD'];
	$formData = getFormData($method);

	return $result = route($method, $urlData, $formData);
}

//получение данных из тела запроса
function getFormData($method) {
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;
 
    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));
 
    foreach($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }
 
    return $data;
}

//направление запроса в нужную функцию
function route($method, $urlData, $formData) {
	if ( $method === 'POST' && isset( $formData['coutry'] ) && isset( $formData['coutry'] ) ) {
		connect__open();
		$result = addToDB($formData['coutry'], $formData['numberOfPeople']);
		connect__close();
		return $result;

	} else if ( $method === 'GET' ) {
		connect__open();
		$result = selectFromDB();
		connect__close();
		return $result;
		
	} else {
		$result['code'] = 400;
		$result['message'] = 'Bad Request';
		return $result;
	}
}

//подключение к MySQL
function connect__open(){
	global $db;
	global $db_config;
	
	try {
		$db = new PDO("mysql:host=" . $db_config['db_server'] . "; dbname=" . $db_config['db_name'], $db_config['db_user'], $db_config['db_password']);
		
	} catch (PDOException $e){
		$result['code'] = 500;
		$result['message'] = 'Incorrect database connection';
		header('HTTP/1.0 500 Internal Server Error');
		header('Content-Type: application/json');
		echo json_encode($result);
		die;
	}
}

//отключение от MySQL
function connect__close(){
	global $db;
	$db=null;
}

//добавление страны в БД
function addToDB($country, $numberOfPeople){
	global $regexp_config;
	
	$resultCountry = preg_match($regexp_config['regexpCountry'], $country);
	$resultNumberOfPeople = preg_match($regexp_config['regexpNumberOfPeople'], $numberOfPeople);
	
	if ( !!$resultCountry && !!$resultNumberOfPeople ){
		global $db;

		$stmt = $db->prepare("INSERT INTO countries (countryName, numberOfPeopleCount) VALUES(:country, :numberOfPeople)");
		$stmt->bindParam(':country', $paramCountry);
		$stmt->bindParam(':numberOfPeople', $paramNumberOfPeople);

		$paramCountry = $country;
		$paramNumberOfPeople = $numberOfPeople;
		$stmt->execute();

		$haystack = $stmt->errorInfo();
		if ($haystack[2] === null){
			$result['code'] = 201;
			$result['message'] = 'add country successful';
			return $result;
			
		} else {
			$result['code'] = 409;
			if ( stripos($haystack[2], 'Duplicate') !== false ){
				$result['message'] = 'country already added';
			}
			else {
				$result['message'] = $haystack[2];
			}
			return $result;
		}
	} else {
		$result['code'] = 400;
		$result['message'] = 'validation error';
		
		$result['country'] = $country;
		$result['regexpCountry'] = $regexp_config['regexpCountry'];
		$result['resultCountry'] = $resultCountry;

		$result['numberOfPeople'] = $numberOfPeople;
		$result['regexpNumberOfPeople'] = $regexp_config['regexpNumberOfPeople'];
		$result['resultNumberOfPeople'] = $resultNumberOfPeople;
		return $result;
	}
}

//получение списка стран
function selectFromDB(){
	global $db;
	
	$stmt = $db->prepare("SELECT countryName, numberOfPeopleCount FROM countries ORDER BY countryName ASC");
	$stmt->execute();

	$content = [];
	$content['result'] = [];
	$ind = 0;
	
	foreach($stmt as $value) {
		$content['result'][$ind] = [];
		$content['result'][$ind][0] = $value['countryName'];
		$content['result'][$ind][1] = $value['numberOfPeopleCount'];
		$ind++;
	}

	$haystack = $stmt->errorInfo();
	if ($haystack[2] === null){
		$content['code'] = 200;
		$content['message'] = 'data received';
		return $content;
		
	} else {
		$content['code'] = 500;
		$content['message'] = 'SQL error';
		return $content;
	}
}
