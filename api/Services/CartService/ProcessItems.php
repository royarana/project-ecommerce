<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class CartItems extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartItemModel.php";
            require_once MODELS."CartModel.php";

            parent::__construct($body, $params, $get, $CartItemModel, $CartModel);
        }

        function sanitazion() {
            
            $rules = array(
                'token' => 'required'
            );
            $this->validationErr($rules, $this->get);
        }

        function middleware() {
            $this->body["user"] = checkLogin($this->get["token"]);
        }

        function run() {
            $user_id = $this->body["user"]["user_id"];
            $items = $this->CartItemsModel->getItems($user_id);

            if (!empty($items["items"])) {
                $cartId = $this->CartsModel->saveCart($user_id, $items["total"]["total"], $this->get["address"]);
                $this->CartItemsModel->whereNull("cart_id");
                $this->CartItemsModel->where("user_id", $user_id);
                $cart = $this->CartItemsModel->update(array("cart_id" => $cartId));
    
                $this->send(
                    $cart,
                    "Items has been checkout Successfully...!"
                );
            } else {
                $this->send(
                    array(),
                    "No Items to be Checkout...!",
                    400
                );
            }
           
        }
    }
    
    $controller = "CartItems";
?>