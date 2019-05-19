<?php

    require API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class ActiveProduct extends Controller {
        
		function __construct($body, $params, $get) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
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
            $this->body["product"] = ProductExist($this->body["barcode"], INACTIVE);
        }

        function run() {
            $this->ProductsModel->active($this->body["product"]["id"]);
            $this->send(
                array(),
                "Products Activated Successfully...!",
                201
            );
        }
    }
    
    $controller = "ActiveProduct";
?>