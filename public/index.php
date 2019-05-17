<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style-homepage.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!-- navbar main -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<div>
				<div class="row">
					<img src = "./images/square_logo.svg">
					<div class="container d-flex flex-column justify-content-start">
				   		<a class="navbar-brand" href="#">JRO Inc.</a>
					    <p class="navbar-brand" href="#">Shoe Shop</p>  
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
			      <a id="a1" class="nav-item nav-link active" href="#">MY ACCOUNT </a>
			      <a id="a1" class="nav-item nav-link" href="#">CHECKOUT</a>
			      <a id="a1"class="nav-item nav-link" href="#">LOGIN</a>
			      <a id="a1"class="nav-item nav-link" href="#">REGISTER</a>
			    </div>
			  </div>

			    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    <div class="navbar-nav" id="nav-home">
			      <a class="nav-item nav-link active" href="#">HOME</a>
			      <a class="nav-item nav-link" href="#">PRODUCTS</a>
			      <a class="nav-item nav-link" href="#">BLOGS</a>
			      <a class="nav-item nav-link" href="#">CONTACT</a>
			    </div>
			</div>
			  </div>
			</div>
		</div>	
	</nav>
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide w-50" data-ride="carousel" >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/carousel4.jpg" class="d-block w-100" alt="..." width="300" height="400">
    </div>
    <div class="carousel-item">
      <img src="images/carousel3.jpg" class="d-block w-100" alt="..." width="300" height="400">
    </div>
    <div class="carousel-item">
      <img src="images/carousel2.jpg" class="d-block w-100" alt="..." width="300" height="400">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!--end carousel -->

<div class="container-2 d-flex flex-column justify-content-end mb-5">
  <div>
	<nav class="navbar navbar-light bg-light">
	  <a class="navbar-brand">Welcome to JRO Inc.</a>
	  <form class="form-inline">
	    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	  </form>
	</nav>
  </div>
</div>

<!-- FEATURE -->

<div class="card bg-dark text-white mb-5">
  <img src="images/carousel4.jpg" class="card-img" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text">Last updated 3 mins ago</p>
  </div>
</div>

<!-- CARD -->

<div class="container d-flex flex-row flex-wrap mb-5">
	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe18.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card ssstitle</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe19.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>


	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe20.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>


	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe21.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe22.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe23.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe24.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card w-25 mt-5 carding ml-4">
		<img src="images/shoe25.jpg" class="card-img-top" alt="..." >
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	
</div>
<!-- END of CARD -->

<footer class = "d-flex flex-wrap justify-content-center">
	<div class="container3 d-flex flex-wrap justify-content-center">
		<div class="col-lg-3">
			<h4>ABOUT JARO INC.</h4>
			<p>lorem ipsudom doremi</p>
			
		</div>
		<div class="col-lg-3">
			<h4>RETAIL & WORKSHOP</h4>
			<p>lorem ipsudom doremi</p>
			
		</div>
		<div class="col-lg-3">
			<h4>GET SOCIAL WITH US!</h4>


		</div> 
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>