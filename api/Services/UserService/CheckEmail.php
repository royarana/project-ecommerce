<?php
   
    function checkEmail($email) {
        require_once MODELS."UserModel.php";
        require_once SITE_ROOT."/api/Libraries/Response.php";
       
       global $UserModel;
       $UserModel->where('email', $email);
       $res = $UserModel->getOne();

       if(!empty($res)) {
           new Response(
                array(
                    "email" => $email
                ), 
                "User Email Exist...!", 
                400
            );
       }
    }
?>