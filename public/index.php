
<!-- navbar main -->
	<?php 
		include './layouts/navbar.php';
	?>
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel" >
  <ol class="carousel-indicators" id = "carousel-num">
  </ol>
  <div class="carousel-inner" id = "carousel-picture">
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

<div class="container d-flex flex-wrap justify-content-between mb-5" id = "featured-products">
	<!-- 
	<div class="card mt-5 carding">
		<img src="images/shoe18.jpg" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Card ssstitle</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		  	<a href="#" class="btn btn-primary">Go somewhere</a>
		</div>
	</div> 
	-->
</div>
<?php 
	include './layouts/footer.php';
?>

<script>
	$(document).ready(function() {
			$.ajax({
				url: API_URL("product/featured"),
				success: function(response){ 
					var data = response.data,
					  carousel = $("#carousel-num"),
						carouselPic = $("#carousel-picture"),
						featuredProducts = $("#featured-products")
					
					carousel.empty();

					data.forEach(function(obj, index) {
						var li = document.createElement('li'),
							div = document.createElement('div'),
							img = document.createElement('img'),
							divProd = document.createElement('div'),
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
							
						li.setAttribute("data-target", "#carouselExampleIndicators")
						li.setAttribute("data-slide-to", index.toString())

						if (index === 0) {
							li.className = "active"
						}

						div.className = (index === 0) ? "carousel-item active" : "carousel-item"
						img.className = "d-block w-100"
						img.setAttribute("alt", "...")
						img.setAttribute("src", obj.picture)
						carousel.append(li)
						div.append(img)
						carouselPic.append(div)

						divProd.className = 'card mt-5 carding'

						featuredImg.className = "card-img-top"
						featuredImg.setAttribute("alt", "...")
						featuredImg.setAttribute("src", obj.picture)
						
						cardBody.className = "card-body"
						cardTitle.className = "card-title"
						cardTitle.innerHTML = obj.description
						pDesc.className = "card-text"
						pDesc.innerHTML =obj.description
						aBuy.append(buyIcon)
						readMore.append(readIcon)
						aBuy.className = "btn btn-primary mx-1"
						readMore.className = "btn btn-success"
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
						featuredProducts.append(divProd)
					})

				}
			});
	});
</script>