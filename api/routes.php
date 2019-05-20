<?php 
	$routes = array(
		"api/user" => "POST UserService/AddUser",
		"api/user/login" => "POST UserService/LoginUser",
		"api/user/token" => "POST UserService/CheckToken",
		"api/user/:id" => "PUT UserService/EditUser",
		"api/product" => "POST ProductService/AddProduct",
		"api/product/barcode/:barcode" => "GET ProductService/ReadProduct",
		"api/product/links" => "GET ProductService/ProductLink",
		"api/product/edit-prod/:id" => "POST ProductService/EditProduct",
		"api/product/active" => "POST ProductService/ActiveProduct",
		"api/product/inactive" => "POST ProductService/InactiveProduct",
		"api/product/featured/add" => "POST ProductService/AddFeatured",
		"api/product/featured/remove" => "POST ProductService/RemoveFeatured",
		"api/product/featured" => "GET ProductService/Featured",
		"api/product/list/:page" => "GET ProductService/GetProduct",
		"api/product/list/:page/:search" => "GET ProductService/GetProduct",
		"api/cart/item/add" => "POST CartService/AddItem",
		"api/cart/item/remove" => "POST CartService/RemoveItem",
		"api/cart/trans-item" => "GET CartService/GetItemsByTrans",
		"api/cart/checkout" => "GET CartService/ProcessItems",
		"api/cart/transactions" => "GET CartService/CartTransactions",
		"api/cart" => "GET CartService/CartItems"
	);
?>