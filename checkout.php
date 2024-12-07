<?php require('header.php');?>
<section class="main-content page-content">
 <div class="container">
   <div class="checkout-container">
        <h1>Checkout</h1>
        <p class="login-coupon">Returning customer? <a href="login.html">Click here to login</a></p>
      
        
        <div class="checkout-content">
            <div class="billing-details">
                <h2>Billing details</h2>
                <form action="#">
                    <label for="email">Email address <span>*</span></label>
                    <input type="email" id="email" required>

                    <label for="first-name">First name <span>*</span></label>
                    <input type="text" id="first-name" required>

                    <label for="last-name">Last name <span>*</span></label>
                    <input type="text" id="last-name" required>

                    <label for="company">Company name (optional)</label>
                    <input type="text" id="company">

                    <label for="address">Street address <span>*</span></label>
                    <input type="text" id="address" placeholder="House number and street name" required>
                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">

                    <label for="city">Town / City <span>*</span></label>
                    <input type="text" id="city" required>

                    <label for="postcode">Postcode <span>*</span></label>
                    <input type="text" id="postcode" required>

                    <label for="county">County (optional)</label>
                    <input type="text" id="county">

                    <label for="phone">Phone <span>*</span></label>
                    <input type="text" id="phone" required>

                    <label>
                        <input type="checkbox"> Create an account?
                    </label>

                    <label>
                        <input type="checkbox"> Ship to a different address?
                    </label>
                </form>
            </div>

            <div class="order-summary">
                <h2>Your order</h2>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td>Book  x 1</td>
                        <td>20 rs</td>
                    </tr>
                    <tr>
                        <td>Book x 1</td>
                        <td>20 rs</td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>20 rs</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>
                            <label><input type="radio" name="shipping" checked> Free shipping</label><br>
                            <label><input type="radio" name="shipping"> Local Pickup: 20 rs</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>20 rs</td>
                    </tr>
                </table>

                <div class="payment-methods">
                    <label>
                        <input type="radio" name="payment" checked> Check payments
                    </label>
                    <p class="check-info">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>

                    <label>
                        <input type="radio" name="payment"> PayPal
                    </label>
                   
                </div>

                <label class="terms">
                    <input type="checkbox" required> I have read and agree to the website terms and conditions *
                </label>

                <a href="thankyou.html" class="btn place-order">Place order</a>
            </div>
        </div>
    </div>
   </div>
</section>
<?php require('footer.php');?>