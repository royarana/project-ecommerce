<?php

    require_once API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class AddFeatured extends Controller {
        
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
            $this->FeaturedModel->setFeatured($this->body["product"]["id"]);
            $this->response(
               array(),
               "Product {$productName} Featured Successfully...!",
               201
            );
        }
    }
    
    $controller = "AddFeatured";
?>