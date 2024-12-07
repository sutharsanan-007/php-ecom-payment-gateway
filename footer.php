
<!-- footer--section -->
<div class="footer-section mt-8 wow fadeInUp ">
	<div class="container">
		<div class="row">
			<div class="col-md-3 cus-footer">
				<img src="images/logo.png">
				<p class="white wow zoomIn">Sri Lalithambika Organisation was founded in the year 1997 by Swami Jagadatmananda Saraswati (Formerly known as Sri Jagannatha Swami), aiming to support people in their walks of life. Coimbatore.</p>
				<ul class="social-logo wow zoomIn">
					<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
					<li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h5 class="wow zoomIn">Contact Us</h5>
				
				
				<h4 class="wow zoomIn white">Address</h4>
				<ul class="quick-links wow zoomIn">
					<p class="white">Sri Lalitambika Peetham 5/109, Anuvavi Subramaniyar Temple Foothills, Periya Thadagam, Coimbatore – 641108. Tamilnadu, INDIA.</p>
							</ul>
							<h4 class="wow zoomIn white">Call Us</h4>
				<ul class="quick-links wow zoomIn">
					<li><a href="#">Trust office : +91 6369 103 912 </a></li>
					<li><a href="#">Mathaji : +91 86673 86703 </a></li>
					<li><a href="#">Santhoshini : +91 80722 22614</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h5 class="wow zoomIn">Our Courses</h5>
				<ul class="quick-links wow zoomIn">
					<li><a href="https://angleritech.co.in/CMS/srilalitam/online-courses/">Online Courses</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/residential-courses/">Residential Courses</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/special-workshop/">Special Workshop</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<h5 class="wow zoomIn">Quick Links</h5>
				<ul class="quick-links wow zoomIn">
						<li><a href="https://angleritech.co.in/CMS/srilalitam/sri-lalithambika-temple/">Sri Lalithambika Peetham</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/sri-anuvavi-anjaneyar/">Sri Anuvavi Anjaneyar</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/saibaba-temple-kotagiri/">Saibaba Temple, Kotagiri</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/gurukulam/">Sri Vidya Gurukulam</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/sri-lalithambika-trust/">Sri Lalithambika Trust</a></li>
					<li><a href="https://angleritech.co.in/CMS/srilalitam/photos/">Gallery</a></li>
				
					<li><a href="https://angleritech.co.in/CMS/srilalitam/contact-us/">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="copy-rights text-center">
	<div class="container">
		<p class="white wow zoomIn">Copyright © Sri Lalitam 2024. All Rights Reserved.</p>
		<p class="white wow zoomIn">Design : <a href="https://www.angleritech.com/" target="_blank">ANGLER Technologies</a> - <a href="https://www.digitalatrium.in/" target="_blank">DigitalAtrium </a></p>
	</div>
</div>
<!-- footer--section -->
<button class="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i><span>Top</span></button>



  <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/wow.js"></script>
     <!-- <script src="js/app.js"></script> -->
   <script src="js/lightbox.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script src="js/script.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function () {
    //   console.log("hi")
      // alert()
    });
	function existsProductCount(){
		let cart = JSON.parse(localStorage.getItem('cart')) || [];
		var cartLength = (cart.length == 0) ? "" : cart.length;
		
		var totalQuantity = cart.reduce(function(total, item) {
        	return total + (item.quantity || 0); // Add the quantity of each item (default to 0 if not specified)
    	}, 0);
		if(cart.length == 0){
			$("#productCountTxt").html("")
		}else{
			$("#productCountTxt").html(`${cartLength} / ${totalQuantity}`);
		}

	}
	existsProductCount()
  </script>
  
</body>

</html>