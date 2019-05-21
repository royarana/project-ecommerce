  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="../jquery.simplePagination.js"></script>
  <script src="../moment.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script>

    (function() {
        window.API_URL = function(url) {
			return "http://localhost/project-ecommerce/index.php/api/" + url
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
    })()
      var admin = localStorage.getItem('admin')

      if(admin) {
        window.admin = JSON.parse(admin)
        loadAdmin(window.admin);
        setTimeout(function() {
        	$('#logout').click(function(event) {
				event.preventDefault();
				localStorage.removeItem('admin')
				location.reload()
			})
        }, 500)
      } else {
        Swal.fire({
			title: 'Login..!',
			type: 'info',
			html:
				'<div class = "row pl-3">Username:</div>' +
				'<input id="user-email" placeholder = "Username" type = "text" class="swal2-input">' +
				'<div class = "row pl-3">Password:</div>' +
				'<input id="password" placeholder = "Username" type = "password" class="swal2-input">',
            cancelButtonColor: '#d33',
            allowOutsideClick: false
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
						localStorage.setItem('admin', JSON.stringify(response.data))
						success(response.message, function() {
							location.reload();
						})
					},
					error: errorAjax
				})
			}
		})
      }
  </script>