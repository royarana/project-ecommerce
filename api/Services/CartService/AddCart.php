<?php

    require API_SERVICE;
    require MODELS."CartItemModel.php";
    require SERVICE_FOLDER."UserService/CheckLogin.php";
    require SERVICE_FOLDER."ProductService/ProductExist.php";

	class AddCart extends Controller {
        
		function __construct($body, $params, $get) {
            global $CartItemModel;
            parent::__construct($body, $params, $get, $CartItemModel);
        }

        function sanitazion() {
            $rules = array(
                'barcode'    => 'required',
                'quantity'    => 'required|integer',
                'token'    => 'required'
            );

            $this->validationErr($rules);
        }

        function middleware() {
            $user = CheckLogin($this->body["token"]);
            $this->body["id"] = $user["user_id"];
            $product = ProductExist($this->body["barcode"]);
            $this->body["product"] = $product;
        }

        function run() {
            
            $product = $this->body["product"];
            $product["product_id"] = $product["id"];
            unset($product["id"]);
            $this->response(
                $models,
                "Products Added Successfully...!",
                201
            );
        }
    }
    
    $controller = "AddCart";
?>