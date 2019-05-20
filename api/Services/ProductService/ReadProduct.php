<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";

	class ReadProduct extends Controller {
        
		function __construct($body = array(), $params = array(), $get = array()) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function sanitazion() {
           
            $rules = array(
                'barcode'    => 'required'
            );

            $this->validationErr($rules, $this->params);
        }

        function run() {
           $this->ProductsModel->where('barcode', $this->params["barcode"]);

           $result = $this->ProductsModel->getOne();

           $this->send(
                $result,
                "Products Retrieved Successfully...!"
            );
        }
    }
    
    $controller = "ReadProduct";
?>