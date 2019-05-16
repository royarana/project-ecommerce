<?php

    require API_SERVICE;
    require MODELS."TestModel.php";
    
	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $TestModel;
            parent::__construct($body, $params, $get, $TestModel, $TestModel);
        }

        function sanitazion() {
            $gump = $this->gump;
            $this->body = $gump->sanitize($this->body);
            
            $gump->validation_rules(array(
                'username'    => 'required|alpha_numeric|max_len,100|min_len,6|max_len,50',
                'full_name'    => 'required|alpha_numeric|max_len,100|min_len,6|max_len,100',
                'password'    => 'required|max_len,100|min_len,6|max_len,50',
                'gender' => 'required|max_len,1|contains,M,F',
                'birthday' => 'required|date',
                'email' => 'required|valid_email'
            ));

            $validated_data = $gump->run($_POST);
            
            if($validated_data === false) {
                $this->validationErr(
                    $gump->get_errors_array()
                );
            }
        }

        function run() {
            $models = $this->TestModel->getOne();
            $this->response(
                $models,
                "Retrieve Data Successfully"
            );
        }
    }
    
    $controller = "AddUser";
?>