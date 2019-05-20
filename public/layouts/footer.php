<!-- END of CARD -->

<footer class = "d-flex flex-wrap justify-content-center">
	<div class="container3 d-flex flex-wrap justify-content-center ">
		<div class="col-lg-3">
			<h6>ABOUT JARO INC.</h6>
			<p>lorem ipsudom doremi</p>
			
		</div>
		<div class="col-lg-3">
			<h6>RETAIL & WORKSHOP</h6>
			<p>lorem ipsudom doremi</p>
			
		</div>
		<div class="col-lg-3">
			<h6>GET SOCIAL WITH US!</h6>
		</div> 
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="./jquery.simplePagination.js"></script>
<script>
	window.user = localStorage.getItem('user')

	if (user) {
		window.user = JSON.parse(user)
		$('#username').html("Hi " + window.user["full_name"])
		$('.login').hide();
		$('.logout').show();
	} else {
		$('.login').show();
		$('.logout').hide();
	}

	getCartItems();

	$('#login').click(function(event) {
		event.preventDefault();
		login()
	})

	$('#checkout').click(function(event) {
		showCartItems()
	})

	$(document).on('click', '.remove-cart-item', function() {
		var button = this,
			id = this.getAttribute('item-id'),
			token = (window.user) ? window.user["token"] : null
		
		Swal.fire({
			title:'Delete Item', text:'Are You Sure To Delete This Item?', icon:'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
		}).then(function(result) {
			if (result.value) {
				Swal.fire('Processing...!')
				$.ajax({
					method: "POST",
					url: API_URL('cart/item/remove'),
					dataType: "json",
					data: {
						id: id,
						token: token
					},
					success: function(response) {
						Swal.fire({
							text: 'Success...!',
							icon: 'success',
							title: response.message
						}).then(function() {
							location.reload()
						})
					},
					error: function(response) {
						console.log(response)
					}
				})
			}
		})
	})

	function login() {
		Swal.fire({
			title: 'Login..!',
			type: 'info',
			html:
				'<div class = "row pl-3">Username:</div>' +
				'<input id="user-email" placeholder = "Username" type = "text" class="swal2-input">' +
				'<div class = "row pl-3">Password:</div>' +
				'<input id="password" placeholder = "Username" type = "password" class="swal2-input">',
			cancelButtonColor: '#d33',
			showCancelButton: true
		}).then((result) => {
			if (result.value) {
				var username = $("#user-email").val(),
				password = $("#password").val(),
				data = {
						email: username,
						password: password
				}
				
				Swal.enableLoading();

				$.ajax({
					method: "POST",
					dataType: "json",
					data: {
						email: username,
						password: password
					},
					url: API_URL('user/login'),
					success: function(response) {
						localStorage.setItem('user', JSON.stringify(response.data))
						success(response.message, function() {
							location.reload();
						})
					},
					error: errorAjax
				})
			}
		})
	}

	$(document).on('keyup', '.price', function() {
		var price = this.getAttribute('price'),
			quantity = this.value

		$("#price").val(formatMoney(price * quantity))
	})

	function sendToCart($barcode, $quantity) {
		Swal.fire('Processing...!')

		var data = {
			barcode: $barcode,
			quantity: $quantity,
			token: window.user.token
		}
		
		if (!window.user) {
			Swal.fire('Error..!', "Login First Before Buying an Item", "error")
			return
		}
		
		$.ajax({
			method: "POST",
			url: API_URL('cart/item/add'),
			dataType: 'json',
			data: data,
			success: function(response) {
				Swal.fire('Success...!', response.message,'success').then(function() { location.reload() })
			}
		})
	}

	$(document).on('click', '.buy-button', function() {
		Swal.enableLoading();
		var barcode = this.getAttribute('barcode')
		
		$.ajax({
			method: "GET",
			url: API_URL('product/barcode/' + barcode),
			success: function(response) {
				var product = response.data
				Swal.fire({
					type: 'info',
					title: 'Buying Item',
					html: 
						'<img class="card-img-top ws-100 buy-item mb-5" alt="..." src="http://localhost/project-ecommerce/public/images/shoe18.jpg">'+
						'<div class = "row"><h5 class = "col-lg-6 text-left">Product Name:</h5> <h6 class = "pt-1 text-right col-lg-6">'+product.description+'</h6></div>' +
						'<div class = "row"><h5 class = "col-lg-6 text-left">Price:</h5> <h6 class = "pt-1 text-right col-lg-6">P '+formatMoney(product.price)+'</h6></div>' +
						'<div class = "row pl-3">Quantity:</div>' +
						'<input id="quantity" price = "'+product.price+'" placeholder = "Quantity"  type = "number" class="form-control price mt-1">' +
						'<div class = "row pl-3">Total:</div>' +
						'<input id="price" placeholder = "Total" type = "text" disabled class="form-control">',
					showCancelButton: true,
					cancelButtonColor: '#d33'
				}).then(function(result) {
					if (result.value) {
						var quantity = $("#quantity").val()
						if (quantity > 0) {
							sendToCart(barcode, quantity)
						} else {
							Swal.fire('Error...!', "Quantity Should be Greater than 0", "error")
						}
					}
				})
			},
			error: errorAjax
		})
	})
</script>
</body>
</html>