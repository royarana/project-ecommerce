<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class CartItems extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartItemModel.php";
            parent::__construct($body, $params, $get, $CartItemModel);
        }

        function sanitazion() {
            
            $rules = array(
                'token' => 'required'
            );
            $this->validationErr($rules, $this->get);
        }

        function middleware() {
            $this->body["user"] = checkLogin($this->body["token"]);
        }

        function run() {
            $items = $this->CartItemsModel->getItems($this->body["user"]["user_id"]);

            $this->send(
                $items,
                "Retrived Cart Items Successfully"
            );
        }
    }
    
    $controller = "CartItems";
?>