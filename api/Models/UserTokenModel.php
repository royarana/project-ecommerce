<?php 
    require_once(API_MODEL);

    class UserTokensModel extends Model {
        function __construct() {
            parent::__construct("User_Tokens");
        }

        function generateToken($models) {
            $this->inactive($models["id"], "user_id");
            
            $data = array(
                "user_id" => $models["id"],
                "token" => $models["token"]
            );
            
            $res = $this->create($data);
            
            $this->where("id", $res);
            $token = $this->getOne();
            
            return $token;
        }
    }
    
    $UserTokenModel = new UserTokensModel();
?>