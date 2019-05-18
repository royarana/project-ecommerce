<?php 
    require_once(API_MODEL);

    class CartsModel extends Model {
        function __construct() {
            parent::__construct();
        }
    }
    
    $CartModel = new CartsModel();
?>