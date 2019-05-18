<?php 
	$routes = array(
		"api/user" => "POST UserService/AddUser",
		"api/user/:id" => "PUT UserService/EditUser",
		"api/product" => "POST ProductService/AddProduct",
		"api/product/featured" => "GET ProductService/Featured",
		"api/product/list/:page" => "GET ProductService/GetProduct",
		"api/product/list/:page/:search" => "GET ProductService/GetProduct"
	);
?>