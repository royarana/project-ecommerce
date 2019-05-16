<?php 
    require API_MODEL;

    class TestModel extends Model {
        function __construct() {
            parent::__construct();
        }
    }
    
    $TestModel = new TestModel();
?>