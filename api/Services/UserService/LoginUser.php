<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    require MODELS."UserTokenModel.php";
    require SERVICE_FOLDER."UserService/ShaPassword.php";
    require SERVICE_FOLDER."UserService/GenerateToken.php";

	class AddUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            global $UserTokenModel;
            parent::__construct($body, $params, $get, $UserModel, $UserTokenModel);
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
                
                $username = $models["email"];
                $models["token"] = GenerateToken($username);

                $this->UserTokensModel->generateToken($models);
                $this->send(
                    $models,
                    "User Credentials Login Successfully...!",
                    200
                );
            } else {
                $this->send(
                    array(),
                    "User Crendentials Incorrect...!",
                    400
                );
            }
        }
    }
    
    $controller = "AddUser";
?>