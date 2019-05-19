<?php 
    require_once(API_MODEL);

    class CartItemModel extends Model {
        function __construct() {
            parent::__construct("Cart_Items");
        }

        function addToCart($quantity, $product, $user_id) {
            
            $product["product_id"] = $product["id"];
            $product["user_id"] = $user_id;
            unset($product["id"]);

            $product["quantity"] = $quantity;
            $id = $this->create($product);

            $this->where('id', $id);

            return $this->getOne();
        }

        function removeToCart($id, $user_id) {

            $this->where("user_id", $user_id);
            return $this->inactive($id);
        }

        function getItems($user_id) {
            $this->where('status', ACTIVE);
            $this->where('user_id', $user_id);

            $res = $this->getRows();

            $this->where('status', ACTIVE);
            $this->where('user_id', $user_id);

            $this->select("SUM(quantity * price) as total");

            $sum = $this->getOne();

            return array(
                "items" => $res,
                "total" => $sum
            );
        }
    }
    
    $CartItemModel = new CartItemModel();
?>