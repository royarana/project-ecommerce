<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    
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

        function setData() {
            $this->ProductsModel->where('status', ACTIVE);

            if (isset($this->params['search'])) {
                $this->ProductsModel->search('description', $this->params["search"]);
            }
            
            if(!empty($this->get)) {
                if (isset($this->get["gender"])) {
                    $gender = implode(",", $this->get["gender"]);
                    $this->ProductsModel->where('gender', $gender, "IN");
                }

                if (isset($this->get["category"])) {
                    $category = implode(",", $this->get["category"]);
                    $this->ProductsModel->where('category_id', $category, "IN");
                }
            }
        }

        function run() {
            $this->setData();
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