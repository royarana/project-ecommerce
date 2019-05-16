<?php

    require API_SERVICE;

	class AddUser extends Controller {
		function __construct($body, $params, $get) {
            parent::__construct($body, $params, $get);
        }

        function run() {
            echo "RUN";
        }
    }
    
    $controller = "AddUser";
?>