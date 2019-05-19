<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class AddItem extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."CartItemModel.php";
            parent::__construct($body, $params, $get, $CartItemModel);
        }

        function sanitazion() {
            $rules = array(
                'barcode' => 'required',
                'quantity' => 'required|integer',
                'token' => 'required'
            );

            $this->validationErr($rules);
        }

        function middleware() {
           $this->body["user"] = checkLogin($this->body["token"]);
           $this->body["product"] = ProductExist($this->body["barcode"]);
        }

        function run() {

            $item = $this->CartItemsModel->addToCart($this->body["quantity"], $this->body["product"], $this->body["user"]["user_id"]);            
            $this->send(
               $item,
               "Product {$item["description"]} to Cart Successfully...!",
               201
            );
        }
    }
    
    $controller = "AddItem";
?>