<?php 
    require_once(API_MODEL);

    class CategoriesModel extends Model {
        function __construct() {
            parent::__construct('categories');
        }
    }
    
    $CategoriesModel = new CategoriesModel();
?>