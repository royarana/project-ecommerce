<?php 
    require_once(API_MODEL);

    class UsersModel extends Model {
        function __construct() {
            parent::__construct();
        }
    }
    
    $UserModel = new UsersModel();
?>