<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    require SERVICE_FOLDER."UserService/shaPassword.php";

	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            parent::__construct($body, $params, $get, $UserModel);
        }

        function sanitazion() {
            $rules = array(
                'email'    => 'required',
                'password'    => 'required'
            );
           
            $this->validationErr($rules);
        }

        function middleware() {
            $this->body["password"] = shaPassword($this->body["password"]);
        }

        function run() {
            $this->UsersModel->where('email', $this->body["email"]);
            $this->UsersModel->where('password', sha($this->body["password"]));
            $models = $this->UsersModel->create($this->body);
            $this->response(
                $models,
                "User Created Successfully...!",
                201
            );
        }
    }
    
    $controller = "AddUser";
?>