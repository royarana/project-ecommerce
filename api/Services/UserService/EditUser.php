<?php

	require API_SERVICE;

	class EditUser extends Controller {
		function __construct($body, $params, $get) {
            parent::__construct($body, $params, $get);
        }

        function run() {
            echo "EDIT";
        }
    }
    
    $controller = "EditUser";
?>