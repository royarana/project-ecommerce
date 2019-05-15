<?php 
	class Controller {
		public $data;

		function __construct($request) {
			$this->data = $request;
		}

		function response($data, $message, $response = 202) {
			header('Content-Type: application/json');
			http_response_code($response);
			$response = array(
				"data" => $data,
				"message" => $message
			);
			echo json_encode($response);
		}
	}
?>