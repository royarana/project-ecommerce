<?php
    require MODELS."UserTokenModel.php";
    require_once SITE_ROOT."/api/Libraries/Response.php";
    
    function checkLogin($token, $id) {
       global $UserTokenModel;
       $UserTokenModel->where('token', $token);
       $UserTokenModel->where('user_id', $id);
       $UserTokenModel->where('status', ACTIVE);
       $res = $UserTokenModel->getOne();

       if(empty($res)) {
           new Response(
                array(
                    "token" => $token,
                    "id" => $id
                ), 
                "User Token is Not Valid Or Inactive...!", 
                400
            );
       }
    }
?>