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
            $this->UsersModel->where('password', $this->body["password"]);
            $this->UsersModel->select('id, full_name, birthday, gender, email');

            $models = $this->UsersModel->getOne($this->body);
            if (!empty($models)) {
                $this->response(
                    $models,
                    "User Credentials Login Successfully...!",
                    201
                );
            } else {
                $this->response(
                    array(),
                    "User Crendentials Incorrect...!",
                    400
                );
            }
        }
    }
    
    $controller = "AddUser";
?>