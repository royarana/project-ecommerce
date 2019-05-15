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

	if (strpos(url(), 'index.php/api')) {
		$requestType = $_SERVER;
		if ($requestType === "GET") {
		    $data = $_GET;
		} else {
			$content = trim(file_get_contents('php://input'));
			$decoded = json_decode($content, true);
			$data = $decoded;
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