<?php

    require API_SERVICE;
    require SERVICE_FOLDER."UserService/CheckLogin.php";

	class CheckToken extends Controller {
        
		function __construct($body, $params, $get) {
            parent::__construct($body, $params, $get);
        }

        function sanitazion() {
            $rules = array(
                'token'    => 'required'
            );
           
            $this->validationErr($rules);
        }

        function middleware() {
            CheckLogin($this->body["token"]);
        }

        function run() {
            $this->send(
                array(),
                "User Token is Active",
                200
            );
        }
    }
    
    $controller = "CheckToken";
?>