<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    require SERVICE_FOLDER."UserService/shaPassword.php";
    require SERVICE_FOLDER."UserService/CheckEmail.php";

	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            parent::__construct($body, $params, $get, $UserModel);
        }

        function sanitazion() {
            $rules = array(
                'full_name'    => 'required|max_len,100|min_len,6',
                'password'    => 'required|max_len,100|min_len,6',
                'gender' => 'required|max_len,1|contains,M F',
                'birthday' => 'required|date',
                'email' => 'required|valid_email'
            );
           
            $this->validationErr($rules);
        }

        function middleware() {
            $this->body["password"] = shaPassword($this->body["password"]);
            checkEmail($this->body["email"]);
        }

        function run() {
            $models = $this->UsersModel->create($this->body);
            $this->send(
                $models,
                "User Created Successfully...!",
                201
            );
        }
    }
    
    $controller = "AddUser";
?>