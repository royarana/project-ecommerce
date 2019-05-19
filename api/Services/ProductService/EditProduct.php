<?php

    require API_SERVICE;
    require MODELS."ProductModel.php";
    require_once SERVICE_FOLDER."UserService/CheckLogin.php";

	class EditProduct extends Controller {
        
		function __construct($body = array(), $params = array(), $get = array()) {
            global $ProductModel;
            parent::__construct($body, $params, $get, $ProductModel);
        }

        function sanitazion() {
            $this->body = array_merge($_FILES, $_POST, $this->params);
            
            $rules = array(
                'description'    => 'required|max_len,100|min_len,6',
                'barcode'    => 'required|max_len,100|min_len,6',
                'price' => 'required|numeric',
                'token' => 'required',
                'id' => 'required'
            );
            
            if (isset($_FILES["picture"])) {
                $rules['picture'] ='required_file|extension,png;jpg;jpeg';
            }

            $this->validationErr($rules);
        }

        function middleware() {
            checkLogin($this->body['token']);

            $this->ProductsModel->where('id', $this->body['id']);
            $res = $this->ProductsModel->getOne();

            if (empty($res)) {
                $this->send(
                    array(),
                    "Product Not Exist",
                    400
                );
            }
        }

        function run() {
            $update = $this->body;
            unset($update["token"]);
            unset($update["id"]);

            if (isset($update["picture"])) {
                $type = end(explode(".", $update["picture"]['name']));
                $file_name = sha1($update["picture"]['name'].uniqid()).".".$type;
                $file_size = $update["picture"]['size'];
                $file_tmp = $update["picture"]['tmp_name'];
                $file_type = $_FILES['picture']['type'];
                $directory = SITE_ROOT."/public/uploads/".$file_name;
                $update["picture"] = $directory;
                
                if($file_size > 2097152) {
                    $this->send(
                        array(),
                        "File Size must be 2mb or below...!",
                        500
                    );
                }

                if (move_uploaded_file($file_tmp, $directory)) {
                    $this->ProductsModel->where('id', $this->body['id']);
                    $models = $this->ProductsModel->update($update);
                    $this->send(
                        $models,
                        "Products Updated Successfully...!",
                        201
                    );
                } else {
                    $this->send(
                        array(),
                        "File Unsuccessfully Uploaded",
                        500
                    );
                }
            } else {
                $this->ProductsModel->where('id', $this->body['id']);
                $models = $this->ProductsModel->update($update);
                $this->send(
                    $models,
                    "Products Updated Successfully...!",
                    201
                );
            }
        }
    }
    
    $controller = "EditProduct";
?>