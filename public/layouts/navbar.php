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
			    <div class="navbar-nav" id="nav-my-account" >
			      <a id="account" class="nav-item nav-link active" href="#">MY ACCOUNT </a>
						<a id="checkout" class="nav-item nav-link" href="#">CHECKOUT</a>
						
						<a id="login" class="nav-item nav-link login" href="#">LOGIN</a>
						<a id="register" class="nav-item nav-link login" href="#">REGISTER</a>

						<a id="logout" class="nav-item nav-link logout" href="#">LOGOUT</a>
			    </div>
			  </div>

			    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav" id="nav-home">
			      <a class="nav-item nav-link active" href="index.php">HOME</a>
			      <a class="nav-item nav-link" href="products.php">PRODUCTS</a>
			    </div>
			</div>
			  </div>
			</div>
		</div>	
	</nav>