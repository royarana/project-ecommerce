<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    require_once SERVICE_FOLDER."UserService/CheckAdmin.php";

	class GetProduct extends Controller {
        
		function __construct($body, $params, $get) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function sanitazion() {
            $rules = array(
                'page'    => 'required|integer'
            );

            if (isset($this->params['search'])) {
                $rules['search'] = 'required';
            }
            $this->validationErr($rules, $this->params);
        }

        function middleware() {
            if (isset($_GET["token"])) {
                CheckAdmin($_GET["token"]);
            }
        }

        function setData() {
            if (!isset($_GET["token"])) {
                $this->ProductsModel->where('products.status', ACTIVE);
            }

            if (isset($this->params['search'])) {
                $this->ProductsModel->search('products.description', $this->params["search"]);
            }

            $this->ProductsModel->join('categories', 'categories.id' , 'products.category_id');
            $this->ProductsModel->leftJoin('featured', 'featured.product_id' , 'products.id');
            
            if(!empty($this->get)) {
                if (isset($this->get["gender"])) {
                    $gender = implode(",", $this->get["gender"]);
                    $this->ProductsModel->where('gender', $gender, "IN");
                }

                if (isset($this->get["category"])) {
                    $category = implode(",", $this->get["category"]);
                    $this->ProductsModel->where('products.category_id', $category, "IN");
                }
            }
        }

        function run() {
            $this->setData();
            $this->ProductsModel->select('products.*, categories.description as category_description, featured.product_id as featured');
            $this->ProductsModel->page($this->params["page"]);
            $models = $this->ProductsModel->getRows();

            $this->setData();
            $rowPaginate = $this->ProductsModel->countRows();
            $models = array_merge(array("data" => $models), array("paginate"=> $rowPaginate));

            $this->send(
                $models,
                "Products Retrieved Successfully...!"
            );
        }
    }
    
    $controller = "GetProduct";
?>