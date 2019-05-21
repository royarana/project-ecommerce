
<!-- navbar main -->
<?php 
		include './layouts/navbar.php';
	?>
<!-- carousel -->

<!--end carousel -->

<!-- DROPDOWN -->
<?php 
	include_once('layouts/search.php');
?>
<div class = "row d-none" id = "info-row">
    <div class = "col-lg-12 py-2"><button class = "btn btn-primary ml-2" id = "edit-info">EDIT INFO</button></div>
</div>
<div class="row">
	<div class = "col-lg-12">
        <table class = "table table-dark table-striped" >
            <thead>
                <tr>
                    <th>Trans #</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody id = "transaction-history">
                <tr><th colspan = "6" class = "text-center"> No Transaction History ...!</th></tr>
            </tbody>
        </table>
	</div>
</div>

<div class = "row mr-5" id = "demo1"></div>
<?php 
	include './layouts/footer.php';
?>

<script>
    setTimeout(function() {
        $(document).ready(function() {
            if (window.user) {
                $("#info-row").removeClass('d-none')

                $("#edit-info").click(function() {
                   Swal.fire('Getting Information')
                   $.ajax({
                        url: API_URL('user/info?token='+window.user["token"]),
                        success: function(response) {
                            var data = response.data
                            console.log(data)
                            var html =
                                '<div class = "row pl-3">Email:</div>' +
                                '<input id="user-email" disabled placeholder = "Email" type = "email" class="swal2-input" value = "'+data.email+'">' +
                                '<div class = "row pl-3">Full Name:</div>' +
                                '<input id="fullname" placeholder = "Full Name" type = "text" class="swal2-input"  value = "'+data.full_name+'">' +
                                '<div class = "row pl-3">Password:</div>' +
                                '<input id="password" placeholder = "Password" type = "password" class="swal2-input"  value = "'+data.password+'">'+
                                '<div class = "row pl-3">Gender:</div>' +
                                '<select id = "gender" class = "swal2-input"><option value = "F">FEMALE</option><option value = "M">MALE</option></select>'+
                                '<div class = "row pl-3">Birthdate:</div>' +
                                '<input id="date" placeholder = "Birthdate" type = "date" class="swal2-input"  value = "'+data.birthday+'">'

                            setTimeout(function() {
                                $('#gender').val(data.gender)
                            }, 500)

                            var url = API_URL('user/edit/'+data.id)

                            Swal.fire({
                                title: "Edit Info",
                                html: html,
                                icon: 'info',
                                showCancelButton: true,
                                cancelButtonColor: "#d33"
                            }).then(function(result) {
                                if (result.value) {
                                    var user = $('#user-email').val()
                                    var password = $('#password').val()
                                    var fullname = $('#fullname').val()
                                    var date = $('#date').val()
                                    var gender = $( "#gender option:selected" ).val()

                                    var data= {
                                        email: user,
                                        password: password,
                                        full_name: fullname,
                                        birthday: date,
                                        gender: gender
                                    }
                                    /*
                    'full_name'    => 'required|max_len,100|min_len,6',
                                    'password'    => 'required|max_len,100|min_len,6',
                                    'gender' => 'required|max_len,1|contains,M F',
                                    'birthday' => 'required|date',
                                    'email' => 'required|valid_email'
                                    */
                                   
                                    $.ajax({
                                        url: url,
                                        method: 'POST',
                                        dataType: 'json',
                                        data:data,
                                        success: function(response) {
                                            success(response.message)
                                        },
                                        error: function(response) {
                                            console.log(response)
                                        }
                                    })
                                }
                            })
                        }
                   })
                })

                $(document).on('click', '.search', function() {
                    var transId = this.getAttribute('trans-id');
                    Swal.fire('Getting Items in Transaction # '+transId)

                    $.ajax({
                        url: API_URL('cart/trans-item'),
                        data: {
                            token: window.user.token,
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

                Swal.fire('Getting Your Transactions');
                $.ajax({
                    url: API_URL('cart/transactions?token='+window.user.token),
                    success: function(response) {
                        var data = response.data,
                            transHistory = $("#transaction-history")

                        Swal.close();
                        if (data.length > 0) {
                            transHistory.empty();
                        }

                        data.forEach(function(row) {
                            var tr = document.createElement('tr'),
                                trans = document.createElement('td'),
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

                            tr.append(trans)
                            tr.append(price)
                            tr.append(date)
                            tr.append(address)
                            tr.append(view)
                            transHistory.append(tr)
                        })
                    },
                    error: function(response) {
                        console.log(response)
                    }
                })
            }
        });
    }, 500)
</script>
