
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

<div class="row">
	<div class = "col-lg-12">
        <table class = "table table-dark table-striped" >
            <thead>
                <tr>
                    <th>Trans #</th>
                    <th>Price</th>
                    <th>Status</th>
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
                            console.log(response)
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
                            date.innerHTML = row.date_created
                            address.innerHTML = row.address

                            button.className = "btn btn-primary btn-sm search"
                            button.innerHTML = "SEARCH"
                            button.setAttribute('trans-id', row.id)
                            
                            view.append(button)

                            tr.append(trans)
                            tr.append(price)
                            tr.append(status)
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
