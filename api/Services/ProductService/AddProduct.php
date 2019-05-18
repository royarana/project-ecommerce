<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    
	class AddProduct extends Controller {
        
		function __construct($body, $params, $get) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function sanitazion() {
            $rules = array(
                'description'    => 'required|max_len,100|min_len,6',
                'barcode'    => 'required|max_len,100|min_len,6',
                'picture' => 'required_file|extension,png;jpg'
            );

            $this->validationErr($rules);
        }

        function run() {
            
            $models = $this->ProductsModel->getRows();
            $this->response(
                $models,
                "Products Added Successfully...!",
                201
            );
        }
    }
    
    $controller = "AddProduct";
?>