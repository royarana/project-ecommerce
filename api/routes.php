<?php 
	$routes = array(
		"api/user" => "POST UserService/AddUser",
		"api/user/login" => "POST UserService/LoginUser",
		"api/user/token" => "POST UserService/CheckToken",
		"api/user/:id" => "PUT UserService/EditUser",
		"api/product" => "POST ProductService/AddProduct",
		"api/product/featured" => "GET ProductService/Featured",
		"api/product/list/:page" => "GET ProductService/GetProduct",
		"api/product/list/:page/:search" => "GET ProductService/GetProduct"
	);
?>