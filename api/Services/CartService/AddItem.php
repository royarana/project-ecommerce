<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class AddItem extends Controller {
        
		function __construct($body, $params, $get) {
            parent::__construct($body, $params, $get, $FeaturedModel);
        }

        function sanitazion() {
            $rules = array(
                'barcode' => 'required',
                'token' => 'required'
            );

            $this->validationErr($rules);
        }

        function middleware() {
           checkLogin($this->body["token"]);
           $this->body["product"] = ProductExist($this->body["barcode"]);
        }

        function run() {
            $productName = $this->body["product"]["description"];
            $this->FeaturedModel->setFeatured($this->body["product"]["id"]);
            $this->send(
               array(),
               "Product {$productName} Featured Successfully...!",
               201
            );
        }
    }
    
    $controller = "AddItem";
?>