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

	$('#login').click(function(event) {
		event.preventDefault();
		login()
	})

	function login() {
		Swal.fire({
			title: 'Login..!',
			type: 'info',
			html:
				'<div class = "row pl-3">Username:</div>' +
				'<input id="username" placeholder = "Username" type = "text" class="swal2-input">' +
				'<div class = "row pl-3">Password:</div>' +
				'<input id="password" placeholder = "Username" type = "password" class="swal2-input">',
			cancelButtonColor: '#d33',
			showCancelButton: true
		}).then((result) => {
			if (result.value) {
				var username = $("#username").val(),
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
						success(response.message, location.reload)
					},
					error: errorAjax
				})
			}
		})
	}
</script>
</body>
</html>