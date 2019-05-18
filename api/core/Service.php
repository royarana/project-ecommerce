<?php 
	define('ACTIVE', 1);
	define('INACTIVE', 0);
	
	interface Api {
		public function sanitazion();
		public function middleware();
		public function run();
	}

	require_once SITE_ROOT."/api/Libraries/GUMP-master/gump.class.php";
	require_once SITE_ROOT."/api/Libraries/Response.php";

	class Controller extends Response implements Api {
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
			$this->gump = new GUMP();
			$this->body = $body;
			$this->params = $params;
			$this->get = $get;

			foreach($args as $arg) {
				$this->{$arg->showTableName()."Model"} = $arg;
			}
			$this->middleware();
			$this->sanitazion();
			$this->run();
		}

		function validationErr($rules, $data = array()) {
			$gump = $this->gump;
			$this->body = $gump->sanitize($this->body);
			$data = (empty($data)) ? $this->body : $gump->sanitize($data);
			$data = $gump->sanitize($data);
            $gump->validation_rules($rules);
            $validated_data = $gump->run($data);
            
            if($validated_data === false) {
                $this->response($gump->get_errors_array(), "Validation Error...!", 400);
			}
			$this->setBody($rules);
		}

		function setBody($rules) {
			$body = array();

			foreach($rules as $index => $value) {
				$body[$index] = $value;
			}

			$this->body = $body;
		}
	}
?>