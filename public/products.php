
<!-- navbar main -->
	<?php 
		include './layouts/navbar.php';
	?>
<!-- carousel -->

<!--end carousel -->

<div class="container-2 d-flex flex-column justify-content-end mb-5">
  <nav class="navbar navbar-light bg-light">
	  <a class="navbar-brand">Welcome to JRO Inc.</a>
	  <form class="form-inline" id = "form-search">
			<input class="form-control mr-sm-2" type="search" id = "find" placeholder="Search" aria-label="Search">
	    <button class="btn btn-outline-success my-2 my-sm-0" id = "search" type="button">Search</button>
	  </form>
	</nav>
</div>

<hr>
<!-- DROPDOWN -->

<div class="row">
	<div class = "col-lg-2 mt-5 mb-5 text-center" id="container-product" >
		<h4>PRODUCT CATEGORY</h4>
		<hr>
		<div id = "product-links">
		</div>
	</div>
	<!-- END OF DROPDOWN -->

	<!-- CARD -->
	<div class = "d-flex flex-wrap mb-5 col-lg-10" id = "products">
	</div>
</div>

<div class = "row mr-5" id = "demo1"></div>
<?php 
	include './layouts/footer.php';
?>

<script>
	$(document).ready(function() {
		var queryString = new URLSearchParams(location.search),
			searchValue = queryString.has('search') ? queryString.get('search') : "",
			products = $("#products"),
			page = 1

		if(searchValue != "") {
			$("#find").val(searchValue)
		}

		$('#demo1').pagination({
			items: 0,
			itemsOnPage: 8,
			cssStyle: 'light-theme',
			onPageClick: function(pageNumber) {
				page = pageNumber
				setTimeout(function (){
					$("#search").trigger('click');
				}, 100);
			}
		});

		$.ajax({
			url: API_URL('product/links'),
			success: function(response) {
				var data = response.data,
					links = Object.keys(data)

				links.forEach(function(row) {
					var link = data[row],
						div = document.createElement('div'),
						button = document.createElement('button'),
						dropdown_menu = document.createElement('div'),
						categoryRow = row.toLowerCase();


					div.className = "dropdown"
					dropdown_menu.className = "dropdown-menu text-right drop-menu"
					dropdown_menu.setAttribute('aria-labelledby', 'dropdownMenuButton')

					button.innerHTML = row
					button.className = "btn dropdown-toggle w-100 mb-2 text-right"

					button.setAttribute("id", "dropdownMenuButton")
					button.setAttribute("data-toggle", 'dropdown')
					button.setAttribute("aria-haspopup", 'true')
					button.setAttribute("aria-expanded", 'false')
					div.append(button)

					link.forEach(function(value) {
						var a = document.createElement('a')
						a.className = "dropdown-item search-category"
						a.setAttribute('category', categoryRow)
						a.setAttribute('id', (categoryRow === "gender") ? value.gender : value.id)
						a.innerHTML = (value.description)
						dropdown_menu.append(a)
					})

					div.append(dropdown_menu)
					$("#product-links").append(div)
				})
				
			}
		})

		$("body").on('click', '.search-category', function(event) {
			var categories = $('.remove-category'),
				textCategory = this.innerHTML,
				id = this.getAttribute("id"),
				catSearch = this.getAttribute("category")

			categories.each(function(row) {
				var button = categories[row]
				if (button.getAttribute("category") === textCategory) {
					removeCategory($(button))
					return false;
				}
			})

			var label = '<label class = "mr-3 p-1 text-white border border-white"> ' + textCategory + ' <button value-id = "'+id+'" category = "'+catSearch+'" type = "button" class = "btn-sm btn btn-danger ml-1 remove-category">X</button> </label>'
			$("#form-search").prepend(label)
		})

		$("body").on('click', '.remove-category', function(event) {
				removeCategory($(this))
		})

		function removeCategory(obj) {
			obj.parent().remove()
		}

		function loadProducts(search = "", category= [], gender = []) {
			var url = API_URL('product/list/' + page)

			if (search !== "") {
				url = url + "/" + search
			}

			products.empty();
			var search = {}

			if (category.length > 0) {
				search.category = category
			}

			if (gender.length > 0) {
				search.gender = gender
			}

			Swal.enableLoading();

			$.ajax({
				url: url,
				data: search,
				success: function(response) {
					
					var result = response.data,
						data = result.data,
						paginate = result.paginate

					$('#demo1').pagination('updateItems', paginate);

					if(data.length > 0) {
						data.forEach(function(row) {
							var divProd = createCard(row)
							products.append(divProd)
						})
					} else {
						var h4 = '<h4 class = "ml-3 text-gray">0 Results...!</h4>';
						products.append(h4)
					}
					Swal.close();
				},
				error: function(response) {
					console.log(response)
				}
			})
		}

		loadProducts(searchValue)

		$("#search").click(function() {
			var category = [],
				gender = [],
				search = $("#find").val(),
				categories = $('.remove-category')
				
			categories.each(function(row) {
				var button = categories[row]
				if (button.getAttribute('category') === 'gender') {
					gender.push(button.getAttribute('value-id'))
				} else {
					category.push(button.getAttribute('value-id'))
				}
			})

			loadProducts(search, category, gender)
		})

	});
</script>
