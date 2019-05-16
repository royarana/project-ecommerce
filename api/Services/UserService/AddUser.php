<?php

    require API_SERVICE;
    require MODELS."TestModel.php";
    
	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $TestModel;
            parent::__construct($body, $params, $get, $TestModel, $TestModel);
        }

        function run() {
           $models = $this->TestModel->get();
        }
    }
    
    $controller = "AddUser";
?>