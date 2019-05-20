<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class GetItemsByTrans extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartItemModel.php";
            parent::__construct($body, $params, $get, $CartItemModel);
        }

        function sanitazion() {
            
            $rules = array(
                'token' => 'required',
                'id' => 'required'
            );
            $this->validationErr($rules, $this->get);
        }

        function middleware() {
            $this->body["user"] = checkLogin($this->body["token"]);
        }

        function run() {
            $this->CartItemsModel->_orderBy = " ORDER BY ID DESC";
            $this->CartItemsModel->where('user_id', $this->body["user"]["user_id"]);
            $this->CartItemsModel->where('cart_id', $this->get["id"]);

            $items = $this->CartItemsModel->getRows();

            $this->send(
                $items,
                "Retrived Cart Items Successfully"
            );
        }
    }
    
    $controller = "GetItemsByTrans";
?>