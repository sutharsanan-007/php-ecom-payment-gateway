<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sri Lalitam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/lightbox.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/ecom.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
<div id="loader" class="loader orange-color">
  <div class="loader-container">
    <div class='loader-icon'> <img src="images/pre.png" alt=""> </div>
  </div>
</div>
  <div class="page-wrapper">
    <div class="header-top">
		  <div class="container">
			  <div class="row">
				  <div class="col-md-12">
					 <a class="navbar-brand" href="https://angleritech.co.in/CMS/srilalitam/shop/"><img src="images/logo.png" alt="logo"></a> 
					  
				  </div>
				 
			  </div>
			 	 
		  </div>
	  </div>
    <!-- header-start -->
  <div class="header" id="myHeader">
        <nav class="navbar navbar-expand-lg ">
          <div class="container">
         
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="https://angleritech.co.in/CMS/srilalitam/shop/">Home</a>
                </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="https://angleritech.co.in/CMS/srilalitam/about-us/">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://angleritech.co.in/CMS/srilalitam/3-temples-donation-2-education-institute-guru-dakshina/">Donation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://angleritech.co.in/CMS/srilalitam/our-guru/">Our Guru</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://angleritech.co.in/CMS/srilalitam/contact-us/">Contact Us</a>
                </li> -->
              </ul>
			
            <div class="box">
              <!-- <div class="cart-counst">  
                <div class="cart-count">0</div>
              
                <i class="fa-solid fa-cart-shopping" name="cart"  id="cart-icon"></i>
              </div>  -->
              <div class="login-signup">
                <?php
                session_start();
                if(!isset($_SESSION['role'])){
                ?>
                  <a href="login.php" class="button1">Login</a>
                  <a href="register.php" class="button1">Register</a>
                <?php
                }else{
                  ?>
                  <div class="d-flex align-items-center">
                    <p class="mx-3">Welcome! <?php echo $_SESSION['name']?></p>
                    <a href="cart.php" class="button1"><i class="fa fa-shopping-cart"></i> <span id="productCountTxt"></span></a>
                    <a href="logout.php" class="button1 mx-2"><i class="fa fa-sign-out"></i> Logout</a>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
        
            <div class="cart">
                <div class="cart-title">Cart Items</div>
                  <div class="cart-content">
                  </div>       
                  <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">Rs.0</div>
                  </div>
                  <button class="btn-buy">Place Order</button>  
                  <i class="fa-solid fa-xmark" name="close" id="cart-close"></i>
                </div>		  
              </div>
          </div>
        </nav>
    </div> 
  </div>
