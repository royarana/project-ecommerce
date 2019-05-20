
<!-- navbar main -->
	<?php 
		include './layouts/navbar.php';
	?>
<link href="https://fonts.googleapis.com/css?family=Bree+Serif|Oleo+Script&display=swap" rel="stylesheet">
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

<?php 
	include_once('layouts/search.php');
?>

<!-- FEATURE -->
<hr>

<div class="card bg-dark text-white mb-5 w-100 h-100 bg-transparent " id="featured-container">
  <img src="images/shoeshoe.jpg" class="card-img " id="featured-img"  alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title text-center" style="font-family: 'Bree Serif', serif; " font size="6">AIR MADULAX</h5>
    <p class="card-text text-center">Highly resistance in water and applicable footwear light weight.</p>
    
  </div>
</div>

<!-- CARD -->
<h4 style="text-align:center; font-family: 'Bree Serif', serif;">FEATURED PRODUCTS</h4>

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

		$("#search").click(function() {
			window.location = PUBLIC_URL('products.php?search='+ $("#find").val())
		})

			$.ajax({
				url: API_URL("product/featured"),
				success: function(response) { 
					var data = response.data,
					  carousel = $("#carousel-num"),
						carouselPic = $("#carousel-picture"),
						featuredProducts = $("#featured-products")
					
					carousel.empty();
					data.forEach(function(obj, index) {
						var li = document.createElement('li'),
							div = document.createElement('div'),
							img = document.createElement('img'),
							divProd = createCard(obj)
							
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

						featuredProducts.append(divProd)
					})
				}
			});
	});
</script>