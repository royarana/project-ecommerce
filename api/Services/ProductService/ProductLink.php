<?php

    require API_SERVICE;
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class ProductLink extends Controller {
        
		function __construct($body = array(), $params = array(), $get = array()) {
            require MODELS."CategoryModel.php";
            require MODELS."GenderModel.php";

            parent::__construct($body, $params, $get, $CategoriesModel, $GenderModel);
        }

        function run() {
            $categories = $this->categoriesModel->getRows();
            $gender = $this->genderModel->getRows();

            $this->send(
                array('Gender' => $gender, 'Categories' => $categories),
                "Product Links Retrieved Successfully...!"
            );
        }
    }
    
    $controller = "ProductLink";
?>