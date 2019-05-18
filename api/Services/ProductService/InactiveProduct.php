<?php

    require API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";
    require_once SERVICE_FOLDER."ProductService/ProductExist.php";

	class InactiveProduct extends Controller {
        
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
            $this->body["product"] = ProductExist($this->body["barcode"]);
        }

        function run() {
            $this->ProductsModel->inactive($this->body["product"]["id"]);
            $this->response(
                array(),
                "Products Deactivated Successfully...!",
                201
            );
        }
    }
    
    $controller = "InactiveProduct";
?>