<?php 
    require_once(API_MODEL);

    class CartItemModel extends Model {
        function __construct() {
            parent::__construct("Cart_Items");
        }

        function addToCart($quantity, $product) {
            $product["product_id"] = $product["id"];
            unset($product["id"]);

            $product["quantity"] = $quantity;
            $id = $this->create($product);

            $this->where('id', $id);

            return $this->getOne();
        }

        function removeToCart($id) {
            return $this->inactive($id);
        }
    }
    
    $CartItemModel = new CartItemModel();
?>