<?php

    require API_SERVICE;
    require MODELS."UserModel.php";
    require SERVICE_FOLDER."UserService/shaPassword.php";

	class EditUser extends Controller {
        
		function __construct($body, $params, $get) {
            global $UserModel;
            parent::__construct($body, $params, $get, $UserModel);
        }

        function sanitazion() {
            $rules = array(
                'full_name'    => 'required|max_len,100|min_len,6|max_len,100',
                'password'    => 'required|max_len,100|min_len,6|max_len,50',
                'gender' => 'required|max_len,1|contains,M F',
                'birthday' => 'required|date'
            );
           
            $this->validationErr($rules);
        }

        function run() {
            $this->UsersModel->where("id", $this->params["id"]);

            $updateUser = $this->UsersModel->getOne();
            if ($updateUser["password"] === $this->body["password"]) {
                unset($this->body["password"]);
            } else {
                $this->body["password"] = shaPassword($this->body["password"]);
            }

            $this->UsersModel->where("id", $this->params["id"]);
            $models = $this->UsersModel->update($this->body);
            
            $this->send(
                $models,
                "User Updated Successfully...!",
                201
            );
        }
    }
    
    $controller = "EditUser";
?>