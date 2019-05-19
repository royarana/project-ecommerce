<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."CartService/ItemExist.php";

	class RemoveItem extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartItemModel.php";
            global $CartItemModel;
            parent::__construct($body, $params, $get, $CartItemModel);
        }

        function sanitazion() {
            $rules = array(
                'id' => 'required',
                'token' => 'required'
            );

            $this->validationErr($rules);
        }

        function middleware() {
           $this->body["user"] = checkLogin($this->body["token"]);
           $this->body["item"] = ItemExist($this->body["id"], $this->body["user"]["user_id"]);
        }

        function run() {
            $this->CartItemsModel->removeToCart($this->body["id"], $this->body["user"]["user_id"]);

            $this->send(
                array(),
               "Product {$this->body["item"]["description"]} in Cart Successfully Removed...!",
               200
            );
        }
    }
    
    $controller = "RemoveItem";
?>