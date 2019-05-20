<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style-homepage.css">
	<link rel="stylesheet" type="text/css" href="simplePagination.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<script>
	(function() {
		window.user = localStorage.getItem('user')

		if (window.user) {
			window.user = JSON.parse(user)
		}

		window.API_URL = function(url) {
			return "http://localhost/project-ecommerce/index.php/api/" + url
		}

		window.PUBLIC_URL = function(url) {
			return "http://localhost/project-ecommerce/public/" + url
		}

		window._100char = function(string) {
			return string.substr(0,100) 
		}

		window.errorAjax = function(response) {
			var err = Object.keys(response.responseJSON.data)
			Swal.fire({
				title: response.responseJSON.message,
				type: "error",
				text: response.responseJSON.data[err[0]]
			})
		}

		window.success = function(message, fn = null) {
			Swal.fire('Success...!', message, 'success').then( 
				function() {
					if (fn !== null) {
						fn();
					}
				}
			)
		}

		window.getCartItems = function () {
			if (window.user.token) {
				console.log('Retrieving Items')
				$.ajax({
					url: API_URL('cart?token='+window.user.token),
					success: function(response) {
						var items = response.data.items.length
						if (items > 0) {
							$("#checkout-items").html(items)
							$("#checkout-items").removeClass("d-none")
						}
					},
					error: function(response) {
						console.log(response)
					}
				})
			}
		}

		window.deleteItem = function(id, token) {
			Swal.enableLoading();
			$.ajax({
				method: "PUT",
				url: API_URL('cart/item/remove'),
				data: {
					id: id,
					token: token
				},
				dataType: 'json',
				success: function(response) {
					success(response.message)
				},
				error: function(err) {
					console.log(err)
				}
			})
		}

		window.showCartItems = function () {
			if (window.user.token) {
				Swal.enableLoading();
				$.ajax({
					url: API_URL('cart?token='+window.user.token),
					success: function(response) {
						var items = response.data.items
						var body = "",
							thead = "<thead><tr><th>Desc</th><th>Price</th><th>Qty</th><th>Total</th><th>Delete</th></tr></thead>"
							itemTotal = 0

						items.forEach(function(row) {
							var total = (row.price * row.quantity)
							itemTotal += total
							body += "<tr><td class = 'text-left'>"+row.description+"</td><td class = 'text-right'>"+formatMoney(row.price)+"</td><td class = 'text-right'>"+row.quantity+"</td><td class = 'text-right'>"+formatMoney(total)+"</td><td><button class = 'btn btn-danger btn-sm remove-cart-item' item-id = '"+row.id+"'><span class = 'text-white'>X</span></button></td></td></tr>"
						})

						body += "<tr><td class = 'text-left'></td><td class = 'text-right'></td><td class = 'text-left'>Item Total</td><td class = 'text-right'>"+formatMoney(itemTotal)+"</td><td></td></tr>"
						body += "<tr><td class = 'text-left'></td><td class = 'text-right'></td><td class = 'text-left'>Address</td><td class = 'text-right'><input id = 'address' class = 'form-controll' /></td><td></td></tr>"
						Swal.fire({
							title: "Cart Items",
							type: 'info',
							customClass: 'swal-wide',
							confirmButtonText: "Process",
							showCancelButton: true,
							cancelButtonColor: '#d33',
							html: "<table class = 'w-100 table'>"+thead+body+"</table><br><div class = 'row text-right'></div>"
						}).then(function(result) {
							if(result.value) {
								processCheckout(window.user.token, $("#address").val())
							}
						})
					},
					error: function(response) {
						console.log(response)
					}
				})
			}
		}

		window.processCheckout = function(token, $address) {
			Swal.fire('Processing...!')
			$.ajax({
				url: API_URL('cart/checkout?token='+token),
				data: { 
					"address": $address
    		},
				success: function(response) {
					Swal.fire('Success...!!', response.message, 'success').then(function() { location.reload() })
				},
				error: function(response) {
					console.log(response)
				}
			})
		}

		window.formatMoney = function(amount, decimalCount = 2, decimal = ".", thousands = ",") {
			try {
				decimalCount = Math.abs(decimalCount);
				decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

				const negativeSign = amount < 0 ? "-" : "";

				let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
				let j = (i.length > 3) ? i.length % 3 : 0;

				return "P " + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
			} catch (e) {
				console.log(e)
			}
		};

		window.createCard = function (obj) {
				var divProd = document.createElement('div'),
					cardBody = document.createElement('div'),
					featuredImg = document.createElement('img'),
					cardTitle = document.createElement('h5'),
					pDesc = document.createElement('p'),
					aBuy = document.createElement('button'),
					readMore = document.createElement('button'),
					buyIcon = document.createElement('i'),
					readIcon = document.createElement('i')
					buyIcon.className = "fas fa-shopping-cart"
					readIcon.className = "fas fa-search"

					divProd.className = 'card mt-5 carding'

					featuredImg.className = "card-img-top"
					featuredImg.setAttribute("alt", "...")
					featuredImg.setAttribute("src", obj.picture)

					cardBody.className = "card-body"
					cardTitle.className = "card-title"
					cardTitle.innerHTML = obj.description
					pDesc.className = "card-text"
					pDesc.innerHTML = _100char(obj.info)
					aBuy.append(buyIcon)
					readMore.append(readIcon)
					aBuy.setAttribute("barcode", obj.barcode)
					aBuy.className = "btn btn-primary mx-1 buy-button"
					readMore.setAttribute("barcode", obj.barcode)
					readMore.className = "btn btn-success read-button"
					aBuy.setAttribute('href', '#')

					var buttonDiv = document.createElement('div')

					buttonDiv.className = "col-lg-12 px-0 mx-0 text-right"
					buttonDiv.append(readMore)
					buttonDiv.append(aBuy)

					cardBody.append(cardTitle)
					cardBody.append(pDesc)
					cardBody.append(buttonDiv)
					divProd.append(featuredImg)
					divProd.append(cardBody)

				return divProd;
		}
	})();
</script>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<div id="navbar-search">
				<div class="row">
					<img src = "./images/square_logo.svg">
					<div class="container d-flex flex-column justify-content-start">
				   		<a class="navbar-brand" href="index.php">JRO Inc.</a>
					    <p class="navbar-brand" href="index.php">Shoe Shop</p>  
				    </div>
				    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				    </button>
			    </div>
		  	</div>
		  	<div class=" d-flex justify-content-end">
		  		<div>
			  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav" id="nav-my-account" style="font-family: 'Niconne', cursive;">
			      <a id="account" class="nav-item nav-link" href="#">MY ACCOUNT </a>
						<a id="checkout" class="nav-item nav-link" href="#">CHECKOUT <span id = 'checkout-items' class = "d-none px-2 border border-info">4</span> </a>
						
						<a id="login" class="nav-item nav-link login" href="#">LOGIN</a>
						<a id="register" class="nav-item nav-link login" href="#">REGISTER</a>

						<a id="logout" class="nav-item nav-link logout" href="#">LOGOUT</a>
			    </div>
			  </div>

			    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav" id="nav-home">
			      <a class="nav-item nav-link" href="index.php">HOME</a>
			      <a class="nav-item nav-link" href="products.php">PRODUCTS</a>
			    </div>
			</div>
			  </div>
			</div>
		</div>	
	</nav>