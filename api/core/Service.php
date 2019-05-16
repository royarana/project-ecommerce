<?php 

	interface Api {
		public function sanitazion();
		public function middleware();
		public function run();
	}

	class Controller implements Api {
		public $data;
		public $body;
		public $params;
		public $get;
		
        public function sanitazion() {

        }

		public function middleware() {

		}

		function run() {
			echo "Controller";
		}
		
		function __construct($body, $params, $get, ...$args) {
			$this->body = $body;
			$this->params = $params;
			$this->get = $get;
			foreach($args as $arg) {
				$this->{$arg->showTableName()."Model"} = $arg;
			}
			$this->run();
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