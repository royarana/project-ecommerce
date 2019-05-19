<?php
    
    require_once SITE_ROOT."/api/Libraries/Response.php";
    require_once MODELS."CartItemModel.php";

    function ItemExist($id) {
        global $CartItemModel;
        $CartItemModel->select("*");
        $res = $CartItemModel->getActive($id);

        if(empty($res)) {
            $resp = new Response();
            $resp->send( 
                array(), 
                "Item To Delete Not Exist...!", 
                400
            );
        }

        return $res;
    }
?>