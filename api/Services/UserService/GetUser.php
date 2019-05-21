<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    require SERVICE_FOLDER."UserService/shaPassword.php";
    require SERVICE_FOLDER."UserService/CheckLogin.php";

	class GetUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            parent::__construct($body, $params, $get, $UserModel);
        }

        function sanitazion() {
            $rules = array(
                'token'    => 'required'
            );
           
            $this->validationErr($rules, $this->get);
        }

        function middleware() {
            $this->body["user"] = checkLogin($this->get["token"]);
        }

        function run() {
            $this->UsersModel->where('id', $this->body["user"]["user_id"]);
            $models = $this->UsersModel->getOne();

            $this->send(
                $models,
                "User Retrieved Successfully...!",
                201
            );
        }
    }
    
    $controller = "GetUser";
?>