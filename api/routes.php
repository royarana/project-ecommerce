<?php 
	$routes = array(
		"api/user" => "POST UserService/AddUser",
		"api/user/:id" => "PUT UserService/EditUser",
		"api/product/:page" => "GET ProductService/GetProduct",
		"api/product/:page/:search" => "GET ProductService/GetProduct"
	);
?>