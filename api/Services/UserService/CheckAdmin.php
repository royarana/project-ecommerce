<?php
    require_once MODELS."UserTokenModel.php";
    require_once SITE_ROOT."/api/Libraries/Response.php";
    
    function CheckAdmin($token) {
       global $UserTokenModel;
        
       $UserTokenModel->join('users', 'users.id', 'user_tokens.user_id');
       $UserTokenModel->where('user_tokens.token', $token);
       $UserTokenModel->where('user_tokens.status', ACTIVE);
       $UserTokenModel->where('users.type', ACTIVE);
       
       $res = $UserTokenModel->getOne();

        if(empty($res)) {
            $resp = new Response();
                $resp->send( 
                    array(
                        "token" => $token
                    ), 
                    "User Token is Not Valid!", 
                    400
            );
        }

       return $res;
    }
?>