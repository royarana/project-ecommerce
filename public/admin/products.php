<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Now UI Dashboard by Creative Tim
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
            <form>
              <div class="input-group no-border">
                <input type="text" id = "find" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text" id = "search">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
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
                        <h4 class="card-title"> Products Table</h4>
                    </div>
                    <div class = "col-lg-6 text-right">
                        <button id = "add-product" class = "btn btn-primary">ADD</button>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  <div class = "row">
                  <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th id = "description-td">
                        Description
                      </th>
                      <th class="text-left resize_th">
                        Info
                      </th>
                      <th class="text-left resize_th">
                        Action
                      </th>
                    </thead>
                    <tbody id = "products">
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
            var page = 1,
                products = $("#products"),
                product_links = {}

            $.ajax({
                url: API_URL('product/links'),
                success: function(response) {
                    product_links = response.data
                }
            })

            var picture = {}
            $(document ).on('change','#picture' , function(e){
                picture = e.target.files[0]
             });

            function loadForm(rowObj = null) {
              var htmlForm = "<input type = 'text' placeholder = 'Barcode' class = 'form-control mb-1' id = 'barcode'>";
                    htmlForm += "<input type = 'text' placeholder = 'Description' class = 'form-control mb-1' id = 'description'>";
                    htmlForm += "<input type = 'text' placeholder = 'Info' class = 'form-control mb-1' id = 'info'>";
                    htmlForm += "<input type = 'number' placeholder = 'Price' class = 'form-control mb-1' id = 'price'>";
                    htmlForm += "<input type = 'number' placeholder = 'Inventory' class = 'form-control mb-1' id = 'inventory'>";
                    htmlForm += "<input type = 'file' multiple accept='image/*' placeholder = 'Picture' class = 'form-control mb-1' id = 'picture'>";
                 
                var genderOption = "",
                    categoryOption = ""

                    product_links.Gender.forEach(function(row) {
                        genderOption += '<option value = "'+row.gender+'">'+row.description+'</option>'
                    })

                    product_links.Categories.forEach(function(row) {
                        categoryOption += '<option value = "'+row.id+'">'+row.description+'</option>'
                    })
                
                htmlForm += "<select id = 'gender' class = 'form-control' >"+genderOption+"</select>"
                htmlForm += "<select id = 'category' class = 'form-control' >"+categoryOption+"</select>"

                var title = (rowObj === null) ? "Add " : "Edit "
                var url = (rowObj === null) ? "product" : "product/edit-prod/" + rowObj.id

                if (rowObj !== null) {
                  setTimeout(function() {
                    $('#barcode').val(rowObj.barcode)
                     $('#description').val(rowObj.description)
                      $('#info').val(rowObj.info)
                       $('#price').val(rowObj.price)
                        $('#inventory').val(rowObj.inventory)

                       $('#gender').val(rowObj.gender)
                       $('#category').val(rowObj.category_id)
                  }, 100)
                }

                Swal.fire({
                    title: title+"Product",
                    type: "info",
                    html: htmlForm,
                    showCancelButton: true
                }).then(function(result) {
                    if (result.value) {
                        var barcode = $('#barcode').val(),
                        description = $('#description').val(),
                        info = $('#info').val(),
                        price = $('#price').val(),
                        inventory = $('#inventory').val(),
                        gender = $("#gender").children(":selected").attr("value"),
                        category = $("#category").children(":selected").attr("value")
                    
                        var obj = {
                            barcode: barcode,
                            description: description,
                            info: info,
                            price: price,
                            inventory: inventory,
                            gender_id: gender,
                            category_id: category
                        }

                        if (picture) {
                          obj.picture = picture
                        }

                        
                        var data = new FormData();
                        data.append("picture", picture);
                        data.append("price", price);
                        data.append("token", admin["token"]);
                        data.append("barcode",obj.barcode);
                        data.append("description",obj.description);
                        data.append("info",obj.info);
                        data.append("inventory",obj.inventory);
                        data.append("gender",obj.gender_id);
                        data.append("category_id", parseInt(obj.category_id));
                        
                        $.ajax({
                            method: "POST",
                            contentType: false,
                            processData: false,
                            data: data,
                            url: API_URL(url),
                            success: function(response) {
                                success(response.message, function() { location.reload() })
                            },
                            error: errorAjax
                        })
                    }
                })
            }

            $('#add-product').click(function() {
                picture = {}
                loadForm();
            })   
            
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

            $("#search").click(function() {
                loadProducts();
            })

            $(document).on('click', '.mr-1', function(event) {
              var productInfo = JSON.parse(this.getAttribute('product-info'))
              loadForm(productInfo)
            })

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

                url = url +"?token="+admin["token"]

                Swal.enableLoading();

                $.ajax({
                    url: url,
                    data: search,
                    success: function(response) {
                        
                        var result = response.data,
                            data = result.data,
                            paginate = result.paginate

                        $('#demo1').pagination('updateItems', paginate);

                        data.forEach(function(row) {
                            var tr = document.createElement('tr')
                                ,description = document.createElement('td')
                                ,info = document.createElement('td')
                                ,picture = document.createElement('td')
                                ,picImg = document.createElement('img')
                                ,statusTd = document.createElement('td')
                                ,statusButton = document.createElement('button')
                                ,editButton = document.createElement('button')
                                
                            picImg.setAttribute('src', row.picture)
                            picImg.className = 'picture-show mt-2'
                            picture.innerHTML = row.description + "</br>"
                            picture.append(picImg)
                            editButton.innerHTML = "EDIT"
                            editButton.className = "btn btn-success mr-1"
                            editButton.setAttribute('product-info', JSON.stringify(row))

                            if (row.status) {
                                statusButton.innerHTML = "DE-ACTIVATE"
                                statusButton.className= "btn btn-danger status"
                                statusButton.setAttribute('status', 'inactive')
                            } else {
                                statusButton.innerHTML = "ACTIVATE"
                                statusButton.className= "btn btn-success status"
                                statusButton.setAttribute('status', 'active')
                            }

                            statusButton.setAttribute('id', row.barcode)

                            var infoLbl = document.createElement('label'),
                                priceLbl = document.createElement('label'),
                                invLbl = document.createElement('label'),
                                category = document.createElement('label'),
                                gender = document.createElement('label'),
                                status = document.createElement('label')

                            infoLbl.innerHTML = "Info: " +row.info
                            infoLbl.className = "row ml-1 mt-1 text-dark"

                            priceLbl.innerHTML = "Price: " + formatMoney(row.price)
                            priceLbl.className = "row ml-1 mt-1 text-dark"

                            invLbl.innerHTML = "Inv: " + (row.inventory)
                            invLbl.className = "row ml-1 mt-1 text-dark"

                            category.innerHTML = "Category / Brand: " + (row.category_description)
                            category.className = "row ml-1 mt-1 text-dark"

                            gender.innerHTML = "Gender: " + (row.gender)
                            gender.className = "row ml-1 mt-1 text-dark"

                            var statusLabel = document.createElement(statusLabel)

                            statusLabel.className = (row.status) ? "badge badge-success" : "badge badge-danger"
                            statusLabel.innerHTML = (row.status) ? "Active" : "Inactive"

                            status.append(statusLabel)
                            status.className = "row ml-1 mt-1 text-dark"

                            picture.append(infoLbl)
                            
                            info.append(priceLbl)
                            info.append(invLbl)
                            info.append(category)
                            info.append(gender)
                            info.append(status)

                            statusTd.append(editButton)
                            statusTd.append(statusButton)

                            tr.append(picture)
                            tr.append(info)
                            tr.append(statusTd)
                            products.append(tr)
                          
                        })

                        Swal.close();
                    },
                    error: function(response) {
                        console.log(response)
                    }
                })
            }

            loadProducts()
            
            $(document).on('click', '.status', function() {
                var type = this.getAttribute('status'),
                    barcode = this.getAttribute('id')
                /*
                'barcode' => 'required',
                'token' => 'required'
                */
                Swal.fire('Processing...!')
                $.ajax({
                    method: 'POST',
                    url: API_URL('product/'+type),
                    data: {
                        barcode: barcode,
                        token: admin["token"]
                    },
                    success: function(response) {
                        success(response.message, function() { location.reload() })
                    },
                    error: function(response) {
                        console.log(response)
                    }
                })  
            })
        })
      }
  </script>
  <?php 
    include_once('footer.php');
  ?>
</body>

</html>