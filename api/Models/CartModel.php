<?php 
    require_once(API_MODEL);

    class CartsModel extends Model {
        function __construct() {
            parent::__construct();
        }

        function saveCart($user_id, $total_price, $address) {
            $data = array(
                "user_id" => $user_id,
                "address" => $address,
                "total_price" => $total_price
            );
            return $this->create($data);
        }
    }

    $CartModel = new CartsModel();
?>