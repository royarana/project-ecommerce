<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    
	class Featued extends Controller {
        
		function __construct($body, $params, $get) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function run() {
            $this->ProductsModel->join('featured', 'featured.product_id', 'products.id');
            $this->ProductsModel->where('featured.status', ACTIVE);
            $this->ProductsModel->where('products.status', ACTIVE);

            $models = $this->ProductsModel->getRows();
            $this->response(
                $models,
                "Products Featured Retrieved Successfully...!"
            );
        }
    }
    
    $controller = "Featued";
?>