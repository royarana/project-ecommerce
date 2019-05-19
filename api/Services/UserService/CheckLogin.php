<?php
    require_once MODELS."UserTokenModel.php";
    require_once SITE_ROOT."/api/Libraries/Response.php";
    
    function checkLogin($token) {
       global $UserTokenModel;
       $UserTokenModel->where('token', $token);
       $UserTokenModel->where('status', ACTIVE);
       $res = $UserTokenModel->getOne();

        if(empty($res)) {
            $resp = new Response();
            $resp->send( 
                array(
                    "token" => $token
                ), 
                "User Token is Not Valid Or Inactive...!", 
                400
            );
       }

       return $res;
    }
?>