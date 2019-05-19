<?php
    
    require_once SITE_ROOT."/api/Libraries/Response.php";
    require_once MODELS."ProductModel.php";
    
    function ProductExist($barcode, $active = ACTIVE) {
        global $ProductModel;
        $ProductModel->select("id, description, barcode, picture, price");
        $res = $ProductModel->getActive($barcode, 'barcode', $active);
        
        if(empty($res)) {
            $resp = new Response();
            $resp->send( 
                array(
                    "barcode" => $barcode
                ), 
                "Barcode does not Exist...!", 
                400
            );
        }

        return $res;
    }
?>