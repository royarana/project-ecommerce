
<!-- navbar main -->
	<?php 
		include './layouts/navbar.php';
	?>
<!-- carousel -->

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

<hr>
<!-- DROPDOWN -->

<div class="row">
	<div class = "col-lg-2 mt-5 mb-5 text-center" id="container-product" >
		<h4>PRODUCT CATEGORY</h4>
		<hr>
		<div>
			<div class="dropdown">
  <button class="btn dropdown-toggle w-100 mb-2 text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    GENDER
  </button>
  <div class="dropdown-menu text-right drop-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">MEN</a>
    <a class="dropdown-item" href="#">WOMEN</a>
    <a class="dropdown-item" href="#">KIDS</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn dropdown-toggle w-100 mb-2 text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    PRODUCT TYPE
  </button>
  <div class="dropdown-menu text-right drop-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">SHOES</a>
    <a class="dropdown-item" href="#">TRAINERS</a>
    <a class="dropdown-item" href="#">SANDALS & FLIP FLOPS</a>
    <a class="dropdown-item" href="#">SPORT SHOES</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn dropdown-toggle w-100 mb-2 text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    SIZE
  </button>
  <div class="dropdown-menu text-right drop-menu" aria-labelledby="dropdownMenuButton"">
    <a class="dropdown-item" href="#">SMALL</a>
    <a class="dropdown-item" href="#">MEDIUM</a>
    <a class="dropdown-item" href="#">LARGE</a>
    <a class="dropdown-item" href="#">EXTRA LARGE</a>
  </div>
</div>


<div class="dropdown">
  <button class="btn dropdown-toggle w-100 mb-2 text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    FABRICATE
  </button>
  <div class="dropdown-menu text-right drop-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">LEATHER</a>
    <a class="dropdown-item" href="#">FABRIC</a>
    <a class="dropdown-item" href="#">RUBBER</a>
  </div>
</div>

		</div>
	</div>
	<!-- END OF DROPDOWN -->

	<!-- CARD -->
	<div class = "d-flex flex-wrap justify-content-between mb-5 col-lg-10" id = "products">
	</div>
</div>
<?php 
	include './layouts/footer.php';
?>

<script>
	$(document).ready(function() {
		var queryString = new URLSearchParams(location.search),
			searchValue = queryString.has('search') ? queryString.get('search') : "",
			products = $("#products")

		function loadProducts(page = 1, search = "") {
			Swal.enableLoading();
			var url = API_URL('product/list/' + page)
			if (search !== "") {
				url = url + "/" + search
			}
			products.empty();

			$.ajax({
				url: url,	
				success: function(response) {
					var data = response.data

					data.forEach(function(row) {
						var divProd = createCard(row)
						products.append(divProd)
					})
					
					Swal.close();
				}
			})
		}

		loadProducts(1, searchValue)
	});
</script>
