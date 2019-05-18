<?php 
    require_once API_MODEL;

    class ProductsModel extends Model {
        function __construct() {
            parent::__construct();
        }
    }
    
    $ProductModel = new ProductsModel();
?>