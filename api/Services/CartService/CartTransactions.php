<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class CartItems extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartModel.php";
            parent::__construct($body, $params, $get, $CartModel);
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
            $this->CartsModel->_orderBy = " ORDER BY ID DESC";
            $this->CartsModel->where('user_id', $this->body['user']['id']);
            $items = $this->CartsModel->getRows();

            $this->send(
                $items,
                "Retrived Cart Items Successfully"
            );
        }
    }
    
    $controller = "CartItems";
?>