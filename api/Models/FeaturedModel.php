<?php 
    require_once(API_MODEL);

    class FeaturedModel extends Model {
        function __construct() {
            parent::__construct("Featured");
        }

        function setFeatured($id) {
            $this->inactive($id, "product_id");
            $this->create(array(
                "product_id" => $id
            ));
        }

        function removeFeatured($id) {
            $this->where("product_id", $id);
            $this->where("status", ACTIVE);
            $res = $this->getOne();
            $this->inactive($res["id"]);
        }
    }
    
    $FeaturedModel = new FeaturedModel();
?>