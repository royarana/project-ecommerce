<?php 
    require_once(API_MODEL);

    class GenderModel extends Model {
        function __construct() {
            parent::__construct('gender');
        }
    }
    
    $GenderModel = new GenderModel();
?>