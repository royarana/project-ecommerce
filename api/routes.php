<?php 
	$routes = array(
		"api/user" => "POST UserService/AddUser",
		"api/user/login" => "POST UserService/LoginUser",
		"api/user/token" => "POST UserService/CheckToken",
		"api/user/:id" => "PUT UserService/EditUser",
		"api/product" => "POST ProductService/AddProduct",
		"api/product/edit/:id" => "POST ProductService/EditProduct",
		"api/product/active" => "PUT ProductService/ActiveProduct",
		"api/product/inactive" => "PUT ProductService/InactiveProduct",
		"api/product/featured/add" => "PUT ProductService/AddFeatured",
		"api/product/featured/remove" => "PUT ProductService/RemoveFeatured",
		"api/product/featured" => "GET ProductService/Featured",
		"api/product/list/:page" => "GET ProductService/GetProduct",
		"api/product/list/:page/:search" => "GET ProductService/GetProduct",
		"api/cart/item/add" => "POST CartService/AddItem",
		"api/cart/item/remove" => "PUT CartService/RemoveItem",
		"api/cart" => "GET CartService/CartItems"
	);
?>