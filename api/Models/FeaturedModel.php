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
            $sql = "DELETE FROM FEATURED where product_id =".$id;
            $stmt = $this->_conn->prepare($sql);
            return $stmt->execute();
        }
    }
    
    $FeaturedModel = new FeaturedModel();
?>