<?php 
    require_once(API_MODEL);

    class CartItemModel extends Model {
        function __construct() {
            parent::__construct("Cart_Items");
        }
    }
    
    $CartItemModel = new CartItemModel();
?>