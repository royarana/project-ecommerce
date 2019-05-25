<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    ADMIN - ECOMMERCE
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../simplePagination.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

</head>

<body class="">
  <div class="wrapper ">
    <?php 
      include_once('sidebar.php')
    ?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Table List</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
           <div class="collapse navbar-collapse justify-content-end" id="navigation">
           <a href = '#' id = 'logout' >Logout</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class = "row">
                    <div class = "col-lg-6">
                        <h4 class="card-title"> Sales Table <a id = "sales" href = "" class = "btn btn-primary text-right" target = "_blank">EXCEL</a></h4>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  <div class = "row">
                  <div class="table-responsive">
                  <table class="table"  id = "products">
                    <thead class=" text-primary">
                      <th>
                        Trans #
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Total
                      </th>
                       <th>
                        Date
                      </th>
                        <th>
                        Address
                      </th>
                        <th>
                        View
                      </th>
                    </thead>
                    <tbody id ='product-body'>
                    </tbody>
                  </table>
                </div>
                  </div>
                  <div class = "container text-right"> <div class = "row" id = "demo1"></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script>
      function loadAdmin(admin) {
        $(document).ready(function() {
          $("#sales").attr("href", API_URL('cart/generate-sales'));
        	$(document).on('click', '.search', function() {
                    var transId = this.getAttribute('trans-id');
                    Swal.fire('Getting Items in Transaction # '+transId)
                    $.ajax({
                        url: API_URL('cart/trans-item'),
                        data: {
                            token: admin["token"],
                            id: transId
                        },
                        success: function(response) {
                            var items = response.data
						    var body = "",
							thead = "<thead><tr><th>Desc</th><th>Price</th><th>Qty</th><th>Total</th><th>Status</th></tr></thead>"
							itemTotal = 0

                            items.forEach(function(row) {
                                var total = (row.price * row.quantity),
                                    status = (row.status) ? '<span class="badge badge-success">Buy</span>' : '<span class="badge badge-danger">Cancelled</span>'
                                
                                    if (row.status) {
                                    itemTotal += total
                                }
                                body += "<tr><td class = 'text-left'>"+row.description+"</td><td class = 'text-right'>"+formatMoney(row.price)+"</td><td class = 'text-right'>"+row.quantity+"</td><td class = 'text-right'>"+formatMoney(total)+"</td><td>"+status+"</td></tr>"
                            })
                            
                            Swal.fire({
                                title: "Cart Items",
                                type: 'info',
                                customClass: 'swal-wide',
                                confirmButtonText: "Close",
                                html: "<table class = 'w-100 table'>"+thead+body+"</table><br><div class = 'row text-right'></div>"
                            })
                        },
                        error: function(response) {
                            console.log(response)
                        }
                    });
                })
            $.ajax({
           		url: API_URL('cart/transactions?token='+admin["token"]),
           		success: function(response) {
           			var data = response.data,
           			  transHistory = $('#product-body'),
           			  table =$('#products')

           			data.forEach(function(row) {
                            var tr = document.createElement('tr'),
                                trans = document.createElement('td'),
                                fullName= document.createElement('td'),
                                price = document.createElement('td'),
                                status = document.createElement('td'),
                                date = document.createElement('td')
                                address = document.createElement('td'),
                                view = document.createElement('td'),
                                button = document.createElement('button')

                            trans.innerHTML = row.id
                            price.innerHTML = formatMoney(row.total_price)

                            status.innerHTML = 'Pending'
                            
                            if(row.status === 1) {
                                status.innerHTML = 'Pending'
                            } else if (row.status === 2) {
                                status.innerHTML = 'Delivering'
                            } else if (row.status === 3) {
                                status.innerHTML = 'Delivered'
                            } else if (row.status === 4) {
                                status.innerHTML = 'Cancelled'
                            }
                            date.innerHTML = moment(row.date_created).format('MMMM Do YYYY, h:mm:ss a')
                            address.innerHTML = row.address

                            button.className = "btn btn-primary btn-sm search"
                            button.innerHTML = "SEARCH"
                            button.setAttribute('trans-id', row.id)
                            
                            view.append(button)
                            fullName.innerHTML = row.full_name
                            tr.append(trans)
                            tr.append(fullName)
                            tr.append(price)
                            tr.append(date)
                            tr.append(address)
                            tr.append(view)
                            transHistory.append(tr)
                        })

           			table.DataTable({
           				"order": [[ 0, 'desc' ]]
           			});
           		}
            })
        })
      }
  </script>
  <?php 
    include_once('footer.php');
  ?>
</body>

</html>