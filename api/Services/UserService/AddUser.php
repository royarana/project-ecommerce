<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    
	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            parent::__construct($body, $params, $get, $UserModel);
        }

        function sanitazion() {
            $rules = array(
                'full_name'    => 'required|alpha_numeric|max_len,100|min_len,6|max_len,100',
                'password'    => 'required|max_len,100|min_len,6|max_len,50',
                'gender' => 'required|max_len,1|contains,M F',
                'birthday' => 'required|date',
                'email' => 'required|valid_email'
            );
           
            $this->validationErr($rules);
        }

        function run() {
            $models = $this->UserModel->create($this->body);
            $this->response(
                $models,
                "User Created Successfully...!",
                201
            );
        }
    }
    
    $controller = "AddUser";
?>