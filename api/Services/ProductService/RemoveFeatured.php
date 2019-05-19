<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class RemoveFeatured extends Controller {
        
		function __construct($body, $params, $get) {
            require_once MODELS."FeaturedModel.php";
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
            $this->FeaturedModel->removeFeatured($this->body["product"]["id"]);
            $this->send(
               array(),
               "{$productName} Remove in Featured Products Successfully...!",
               201
            );
        }
    }
    
    $controller = "RemoveFeatured";
?>