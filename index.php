<?php 

	require './api/routes.php';

	function url(){
	    if(isset($_SERVER['HTTPS'])){
	        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	    }
	    else{
	        $protocol = 'http';
	    }
	    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	function getUrlVar() {
		$current_url = explode("/", $_SERVER['REQUEST_URI']);
		$current_url = $current_url[end(array_keys($current_url))];
		return $current_url;
	}

	if (strpos(url(), 'index.php/api')) {
		$requestType = $_SERVER;
		if ($requestType === "GET") {
		    $data = $_GET;
		} else {
			$content = trim(file_get_contents('php://input'));
			parse_str($_SERVER["QUERY_STRING"], $requestUri);
			$data = json_decode($content, true);
			$data = array_merge($data, $requestUri);
			print_r($data);
		}
	} else {
		header('Content-Type: application/json');
		$uri = $_SERVER['REQUEST_URI'];
		$response = array(
			"message" => "Request Not Found {$uri}"
		);
		http_response_code(500);
		echo json_encode($response);
	}
?>