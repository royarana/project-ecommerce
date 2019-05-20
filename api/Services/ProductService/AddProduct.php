<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class AddProduct extends Controller {
        
		function __construct($body = array(), $params = array(), $get = array()) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function sanitazion() {
            $this->body = array_merge($_FILES, $_POST);
            
            $rules = array(
                'description'    => 'required|max_len,100|min_len,6',
                'barcode'    => 'required|max_len,100|min_len,6',
                'picture' => 'required_file|extension,png;jpg;jpeg',
                'price' => 'required|numeric',
                'token' => 'required',
                'category_id' => 'required',
                'gender' => 'required',
                'inventory' => 'required',
                'info' => 'required'
            );
            
            $this->validationErr($rules);
        }

        function middleware() {
            checkLogin($this->body['token']);
        }

        function run() {
            $create = $this->body;
            unset($create["token"]);
            
            $type = explode(".", $create["picture"]['name']);
            $type = end($type);
            $file_name = sha1($create["picture"]['name'].uniqid()).".".$type;
            $file_size = $create["picture"]['size'];
            $file_tmp = $create["picture"]['tmp_name'];
            $file_type = $_FILES['picture']['type'];
            $directory = SITE_ROOT."/public/uploads/".$file_name;
            $create["picture"] = $directory;
            
            if($file_size > 2097152) {
                $this->send(
                    array(),
                    "File Size must be 2mb or below...!",
                    500
                );
            }

            if (move_uploaded_file($file_tmp, $directory)) {
                $create["picture"] = PUBLIC_FOLDER."uploads/".$file_name;
                $models = $this->ProductsModel->create($create);
                $this->send(
                    $models,
                    "Products Added Successfully...!",
                    201
                );
            } else {
                $this->send(
                    array(),
                    "File Unsuccessfully Uploaded",
                    500
                );
            }
        }
    }
    
    $controller = "AddProduct";
?>