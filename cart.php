<?php
session_start();
if(!isset($_SESSION['role'])){
    header("Location: login.php");
}
?>
<?php require('header.php');?>
<style>
        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Collapses borders */
            margin: 20px 0; /* Space around the table */
        }

        th, td {
            border: 1px solid #ddd; /* Light gray border */
            padding: 8px; /* Padding inside cells */
            text-align: left; /* Align text to the left */
        }

        th {
            background-color: #f2f2f2; /* Light gray background for headers */
            font-weight: bold; /* Bold font for headers */
        }

        tr:hover {
            background-color: #f5f5f5; /* Highlight row on hover */
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-control button {
            margin: 0 5px;
        }
</style>
<section class="main-content page-content">
 <div class="container">
   <div class="cart-container">
        <h1>Your Products</h1>
        
		<div id="cart-container">

        </div>
        <a href="index.php">Countinue to shoping</a>
		<p>Note: We do not ship products internationally; delivery is available only within India.</p>
    </div>
   </div>
</section>
<?php require('footer.php');?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var grandWholeTotal = 0;
    var payment_id = "";
    var order_id = "";
    var signature = "";
    function displayCart() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const cartContainer = document.getElementById('cart-container');
        cartContainer.innerHTML = ''; // Clear any existing content

        if(cart.length == 0){
            let div = document.createElement('div');
            div.innerHTML = `<img src="images/empty-cart-image.png" style="width: 350px;display: block;margin: auto">`;
            cartContainer.appendChild(div);
        }else{
            let table = document.createElement('table');
            table.border = '1'; // Optional: Add a border to the table
            // table.className = 'table ';

            // Create table headers
            let headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Sno</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            `;
            table.appendChild(headerRow);

            // Populate the table with cart items
            var grandTotal = 0
            var grandQuantity = 0
            var sno = 0;
            cart.forEach(product => {
                var total = product.quantity * product.price;
                grandTotal = grandTotal + total;
                grandQuantity = grandQuantity + product.quantity
                let row = document.createElement('tr');
                sno++;
                row.innerHTML = `
                    <td>${sno}</td>
                    <td><img src="../admin/uploads/products/${product.image}" style="width: 100px;"></td>
                    <td>${product.name}</td>
                    <td>&#x20B9; ${product.price}</td>
                    <td>
                        <div class="quantity-control">
                            <span onclick="changeQuantity(${product.id}, -1)" class="bg-primary rounded-circle px-2 py-1 text-white mx-2" role="button"><i class="fa-solid fa-minus"></i></span>
                            <span>${product.quantity}</span>
                            <span onclick="changeQuantity(${product.id}, 1)" class="bg-primary rounded-circle px-2 py-1 text-white mx-2" role="button"><i class="fa-solid fa-plus"></i></span>
                        </div>
                    </td>
                    <td>&#x20B9; ${total}</td>
                    <td><span style="color: red" role="button" onclick="removeProduct(${product.id})"><i class="fa-solid fa-trash"></i></span></td>
                `;
                table.appendChild(row);
            });
            $("#grandtotalproduct").html(grandTotal);
            // $("#grandtotalquantity").html(grandQuantity);
            // grandQuantity
            cartContainer.appendChild(table);
            var postalChargeAmount = 250;

            grandWholeTotal = grandTotal + postalChargeAmount

            const grandTotalElement = document.createElement('h4');
            grandTotalElement.style.textAlign = 'right';
            grandTotalElement.innerHTML = `Total: &#x20B9; <span id="grandtotalproduct">${grandTotal}</span>`;
            cartContainer.appendChild(grandTotalElement);

            const postalCharge = document.createElement('h4');
            postalCharge.style.textAlign = 'right';
            postalCharge.innerHTML = `Postal Charge: &#x20B9; <span id="postalcharge">${postalChargeAmount}</span>`;
            cartContainer.appendChild(postalCharge);
            
            const wholeTotal = document.createElement('h3');
            wholeTotal.style.textAlign = 'right';
            wholeTotal.className = 'my-3';
            wholeTotal.innerHTML = `Grand total: &#x20B9; <span>${grandWholeTotal}</span>`;
            cartContainer.appendChild(wholeTotal);

            // Create a div with Bootstrap classes
            const buttonContainer = document.createElement('div');
            buttonContainer.classList.add('d-flex', 'justify-content-end', 'align-items-end');

            // Create the Buy button
            const buyButton = document.createElement('button');
            buyButton.innerText = 'Proceed to Buy';
            buyButton.id = 'buyButtonId';
            buyButton.classList.add('btn', 'btn-primary', 'my-3'); // Add Bootstrap button classes
            buyButton.onclick = onSubmit; // Set the onclick function
            // buyButton.onclick = proceedToBuy;
            // Append the button to the div
            buttonContainer.appendChild(buyButton);

            // Append the div to your cart container
            cartContainer.appendChild(buttonContainer);

        }
    
    }

    // Call the function to display the cart
    displayCart();

    function removeProduct(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Filter out the product with the specified ID
        cart = cart.filter(product => product.id !== productId);

        // Update local storage
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart(); // Re-render the cart
        existsProductCount()
    }

    function changeQuantity(productId, amount) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let product = cart.find(p => p.id === productId);
        
        if (product) {
            product.quantity += amount; // Update quantity

            // Remove product if quantity is less than 1
            if (product.quantity < 1) {
                cart = cart.filter(p => p.id !== productId); // Remove from cart
            }

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart(); // Re-render the cart
            existsProductCount()
        }
    }
    
    function clearCart() {
      localStorage.removeItem('cart');
    }
    
    function proceedToBuy(){
        console.log("buy")
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log(cart)
    
        cart.forEach(function(item) {
            item.payment_id = payment_id;
            item.order_id = order_id;
            item.signature = signature;
        });
        const requestData = {
            cart: cart
        };
        // console.log(requestData)
        // return false
        $.ajax({
            type: "POST",
            url: "query_shop/cart_query.php",
            data: JSON.stringify(requestData),
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                console.log(data)
                Swal.fire({
                  // title: "The Internet?",
                  text: data.message,
                  icon: data.event
                });
                clearCart();
                  displayCart(); // Re-render the cart
            existsProductCount()
            },
        });
    }
    function paymentStatus(rzrStatus,response){
      var res_payment_id = ""
      var res_order_id = ""
      var res_signature = ""
      var code = ""
      var description = ""
      var source = ""
      var step = ""
      var reason = ""
      
      if(rzrStatus == "success"){
        res_payment_id = response.razorpay_payment_id;
        res_order_id = response.razorpay_order_id;
        res_signature = response.razorpay_signature;
      }
      if(rzrStatus == "failed"){
        code = response.error.code
        description = response.error.description
        source = response.error.source
        step = response.error.step
        reason = response.error.reason
        res_order_id = response.error.metadata.order_id
        res_payment_id = response.error.metadata.payment_id
      }

      const formData = new FormData()
      formData.append('payment_id' , res_payment_id);
      formData.append('order_id' , res_order_id);
      formData.append('signature' , res_signature);
      formData.append('code' , code);
      formData.append('description' , description);
      formData.append('source' , source);
      formData.append('step' , step);
      formData.append('reason' , reason);
      formData.append('status' , rzrStatus);

      $.ajax({
          type: "post",
          url: "../query/payment_query.php",
          processData: false, // Important for FormData
          contentType: false, // Important for FormData
          data: formData,
          success: function (response) {
              console.log(response)
              var data = JSON.parse(response);
    
              if(data.event == "success"){
                proceedToBuy()
                // Swal.fire({
                //   text: data.message,
                //   icon: data.event
                // });
              }
          }
      });
    }
    function openRazorpay(keyId,amount,orderId){
        // console.log("hi")
        paymentFailed = 0
        var options = {
            "key": keyId, // Razorpay Key ID
            "amount": amount,        // Amount in paise (1000 paise = 10 INR)
            "currency": "INR",
            "order_id": orderId,  // Order ID generated by your backend
            "handler": function (response) {
                if(paymentFailed == 1){
                  console.log("failed successfully")
                  return false
                }
                // Send the payment details to your server to verify the payment and store in the database
                payment_id = response.razorpay_payment_id;
                order_id = response.razorpay_order_id;
                signature = response.razorpay_signature;
                // console.log(response)
                console.log('payment.success')
                rzrStatus = "success";
                paymentStatus(rzrStatus,response)
                // console.log("response handler" + JSON.stringify(response))
                // Call your PHP script to verify the payment and store it in the database
                // serverPaymentStatus(payment_id,order_id,signature,amount,rzrStatus)
            },
            "theme": {
                "color": "#a72617"
            },
            // "callback_url": "https://angleritech.co.in/CMS/srilalitam/thankyou.php",
            // "redirect": true,
            "modal": {
              "ondismiss": function () {
                if (confirm("Are you sure, you want to close the form?")) {
                  txt = "You pressed OK!";
                  console.log("Checkout form closed by the user");
                } else {
                  txt = "You pressed Cancel!";
                  console.log("Complete the Payment")
                }
              }
            }
        };
        var razorpayInstance = new Razorpay(options); // Initialize the Razorpay instance with the options
        razorpayInstance.on('payment.failed', function (response){
            rzrStatus = "failed"
            paymentFailed = 1
            console.log('payment.failed')
            console.log(response)
            paymentStatus(rzrStatus,response)
            // return false
            // alert(response.error.code);
            // alert(response.error.description);
            // alert(response.error.source);
            // alert(response.error.step);
            // alert(response.error.reason);
            // alert(response.error.metadata.order_id);
            // alert(response.error.metadata.payment_id);
        });
        razorpayInstance.open();
    }

    function onSubmit(){
       $("#buyButtonId").prop("disabled", true).html("Please wait...");
        const formData = new FormData()
        formData.append('amount' , grandWholeTotal);
        $.ajax({
            type: "post",
            url: "../RazorPayIntegration/pay.php",
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            data: formData,
            success: function (response) {
                console.log(response)
                $("#buyButtonId").prop("disabled", false).html("Proceed to Buy");
                var data = JSON.parse(response);
                var keyId = data.keyId;
                var amount = data.amount;
                var orderId = data.order_id
                openRazorpay(keyId,amount,orderId)
            }
        });
    }
</script>

