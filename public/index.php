
<!-- navbar main -->
	<?php 
		include './layouts/navbar.php';
	?>
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel" >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/carousel7.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/carousel8.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/carousel9.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  	<div class = "carousel-button w-25 pt-1">
			  	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
		  	</div>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  	<div class = "carousel-button w-25 pt-1">
			    <span class="carousel-control-next-icon carousel-button w-25 " aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			</div>
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
  <img src="images/carousel10.jpg" class="card-img" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text">Last updated 3 mins ago</p>
  </div>
</div>

<!-- CARD -->

<div class="container d-flex flex-wrap justify-content-between mb-5">
	<div class="card mt-5 carding">
		<img src="images/shoe18.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card ssstitle</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card mt-5 carding">
		<img src="images/shoe19.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>


	<div class="card mt-5 carding">
		<img src="images/shoe20.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>


	<div class="card mt-5 carding">
		<img src="images/shoe21.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card mt-5 carding">
		<img src="images/shoe22.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card mt-5 carding">
		<img src="images/shoe23.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card mt-5 carding">
		<img src="images/shoe24.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	<div class="card mt-5 carding ">
		<img src="images/shoe25.jpg" class="card-img-top" alt="..." >
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div>

	
</div>
<?php 
	include './layouts/footer.php';
?>