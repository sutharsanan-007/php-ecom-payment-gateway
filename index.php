<?php
session_start();
$checkUser = "";
if(isset($_SESSION['role']) && $_SESSION['role'] == 2){
  $checkUser = "user found";
}else{
  $checkUser = "no user";
}
?>
<?php require('header.php');?>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<style>
  /* Style the category slider container */
.category-slider-container {
  display: flex; /* Align children in a row */
  overflow-x: auto; /* Enable horizontal scrolling */
  scroll-snap-type: x mandatory; /* Optional: snap to each item */
  gap: 20px; /* Space between the category items */
  padding-bottom: 20px; /* Padding at the bottom for better visual effect */
}

.category-slider-container .col-3 {
  flex-shrink: 0; /* Prevent items from shrinking */
  width: 25%; /* 4 items per row, adjust as necessary */
  scroll-snap-align: center; /* Optional: smooth snapping to the center */
}

.category-circle {
  text-align: center; /* Center the text and image */
  /* border-radius: 50%; Make the div circular */
  overflow: hidden; /* Ensure the image is contained in the circle */
}

.category-circle img {
  width: 100%; /* Ensure the image fits inside the circle */
  height: auto;
  border-radius: 50%; /* Make the image circular */
}

h5 {
  margin-top: 10px; /* Add some space between the image and text */
  font-size: 16px;
  font-weight: bold;
}

button {
  padding: 10px 20px;
  margin: 10px;
  cursor: pointer;
}

#prev-btn, #next-btn {
  position: fixed;
  top: 50%;
  transform: translateY(-50%);
  background-color: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
}

#prev-btn {
  left: 10px;
}

#next-btn {
  right: 10px;
}

  .image-container {
    overflow: hidden; /* Prevents overflow of the zoomed image */
    height: 400px;
  }

  .zoom-image {
      width: 100%; /* Make the image responsive */
      transition: transform 0.3s ease; /* Smooth transition for zoom effect */
  }

  .image-container:hover .zoom-image {
      transform: scale(1.2); /* Scale the image on hover */
  }
 /*  .list label {
    padding: 13px 34px;
    font-family: poppins;
    font-size: 16px;
    font-weight: 600;
    border: 0.6mm solid black;
    border-radius: 7mm;
    margin: 5px;
    cursor: pointer;
  } */
  /* .list input {
    display: none;
  } */
  .list input:checked + label {
    color: rgb(0, 120, 230);
    border-color: rgb(15, 150, 255);
    background: rgb(230, 245, 255);
  }
</style>
<!-- <section class="sub-banner" style="background-image:url(https://angleritech.co.in/CMS/srilalitam/wp-content/uploads/2024/09/gur.jpg)">
  <div class="container">
      <div class="row">
        <div class="col-lg-12 col-xs-12 text-white">
          <h3>Products</h3>
        </div>       
      </div>
  </div>
</section> -->
  <div class="catageories my-5">
    <div class="container">
      <h2 class="text-center mb-5">Religious & Spiritual Items</h2>
      <!-- <div class="testimonial-slider owl-carousel" id="category-slider"> -->
        <!-- <div class="col-xl-3">
          <a href="collections.php">
            <div class="category-circle">
              <img src="images/book1.jpeg" alt="Category 1">
              <h5>Books</h5>
            </div>
          </a>
        </div>
        <div class="col-xl-3">
          <a href="collections.php">
            <div class="category-circle">
              <img src="images/book2.jpeg" alt="Category 1">
                <h5>Books</h5>
            </div>
          </a>
        </div> -->
      <!-- </div> -->
       <!-- <marquee behavior="" direction=""> -->
        <div  class="category-slider-container">
            <!-- Categories will be inserted dynamically by JavaScript -->
        </div>
        <marquee loop="infinite" onMouseOver="this.stop()" onMouseOut="this.start()">
          <div class="d-flex" id="category-slider">

          </div>
        </marquee>
       <!-- </marquee> -->
        

    </div>
  </div>
<!-- -->

<!-- -->

<section class="main-content page-content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 border-end">
          <h4 class="mb-2">Categories</h4>
          <div class="list mb-3" id="category_div">
		          <!-- <div>
                <input type="checkbox" name="category" id="opt1" value="1" />
                <label for="opt1"> Books </label>
              </div>
              <div>
                    <input type="checkbox" name="category" id="opt2" value="2" />
                    <label for="opt2"> Spiritual articles </label>
              </div>
              <div>
                    <input type="checkbox" name="category" id="opt3" value="3" />
                    <label for="opt3"> Audio </label>
              </div>
              <div>
                    <input type="checkbox" name="category" id="opt4" value="4" />
                    <label for="opt4"> Maalas </label>
              </div>
              <div>
                    <input type="checkbox" name="category" id="opt5" value="5" />
                    <label for="opt5"> Idols </label>
              </div>
              <div>
                    <input type="checkbox" name="category" id="opt6" value="6" />
                    <label for="opt6"> Pooja Items </label>
              </div> -->
          </div>
          <div class="d-flex justify-content-around">
            <button class="btn btn-primary" onclick="applyFilter()">Apply</button>
            <button class="btn" onclick="clearSelection()">Clear</button>
          </div>
        </div>
        <div class="col-md-10">
		  <div class="d-flex justify-content-between align-items-center mb-4">
        <select class="form-select w-auto" id="filter_by_price" onchange="applyFilter()">
          <option value="">Filter By Prices</option>
          <option value="low to high">Low to High</option>
          <option value="high to low">High to Low</option>
        </select>
      </div>
          <div class="shop-content" id="productShow">
            <div class="row">
            </div>
          </div>
        </div>
      </div>
  </div>     
</section>
<?php require('footer.php');?>
<script>
      existsProductCount()
  var productsData = [];
    // const productsData = [
    //   {id: 1, name: "Book One", category: 1, image: "images/book1.jpeg",price: 150},
    //   {id: 2, name: "Book Two", category: 1, image: "images/book2.jpeg",price: 100},
    //   {id: 3, name: "Book Three", category: 1, image: "images/book3.jpeg",price: 200},
    //   {id: 4, name: "Book Four", category: 1, image: "images/book4.jpeg",price: 150},
    //   {id: 5, name: "Book Five", category: 1, image: "images/book5.jpeg",price: 100},
    //   {id: 6, name: "Book Six", category: 1, image: "images/book6.jpeg",price: 200},
    //   {id: 7, name: "Book Seven", category: 1, image: "images/book7.jpeg",price: 150},
    //   {id: 8, name: "Spiritual articles 1", category: 2, image: "images/s_article_1.jpg",price: 200},
    //   {id: 9, name: "Spiritual articles 2", category: 2, image: "images/s_article_2.jpg",price: 100},
    //   {id: 10, name: "Spiritual articles 3", category: 2, image: "images/s_article_3.jpg",price: 300},
    //   {id: 11, name: "Audio Book 1", category: 3, image: "images/audio_book_1.jpg",price: 100},
    //   {id: 12, name: "Audio Book 2", category: 3, image: "images/audio_book_2.jpg",price: 300},
    //   {id: 13, name: "Audio Book 3", category: 3, image: "images/audio_book_3.jpg",price: 200},
    //   {id: 14, name: "Maalas 1", category: 4, image: "images/maalas_1.jpg",price: 200},
    //   {id: 15, name: "Maalas 2", category: 4, image: "images/maalas_2.jpg",price: 400},
    //   {id: 16, name: "Idols 1", category: 5, image: "images/idols_1.jpg",price: 500},
    //   {id: 17, name: "Idols 2", category: 5, image: "images/idols_2.jpg",price: 400},
    //   {id: 18, name: "Idols 3", category: 5, image: "images/idols_3.jpg",price: 700},
    //   {id: 19, name: "Pooja item 1", category: 6, image: "images/pooja_item_1.jpg",price: 100},
    //   {id: 20, name: "Pooja item 2", category: 6, image: "images/pooja_item_2.jpg",price: 200},
    //   {id: 21, name: "Pooja item 3", category: 6, image: "images/pooja_item_3.jpg",price: 300},
    // ]
  function appendProductSection() {
    const container = document.getElementById('productShow').querySelector('.row');

    productsData.forEach(item => {
      const card = document.createElement('div');
      card.className = 'col-md-3 mb-3';

      card.innerHTML = `
          <div class="food-box">
            <div class="image-container d-flex justify-content-center align-items-center">
              <img src="${item.image}" alt="" class="zoom-image center-img-auto mb-3" width="100">
            </div>
            <div class="pricess">
              <h3 class="mb-3">${item.name}</h3>
              <div class="d-flex justify-content-between align-items-center">
                <p style="font-size: 20px;">&#x20B9; ${item.price}</p>
                <button type="button" class="btn" onclick="addToCart(${item.id})"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
              </div>
            </div>   
          </div>
      `;
      container.appendChild(card);
    });
  }

  // appendProductSection()

  function fetchCategories() {
    $.ajax({
        type: "POST",
        url: "query_shop/category_query.php",
        data: {},
        processData: false, // Important for FormData
        contentType: false, // Important for FormData
        success: function (response) {
            console.log(response);
            var data = JSON.parse(response);
            console.log(data);
            $('#category_div').empty();

            categoriesData = data.data;
            
            // Loop through categories and create checkbox elements
            $.each(categoriesData, function(index, category) {
                var checkbox = $('<input>', {
                    name: 'category',
                    type: 'checkbox',
                    id: 'category_' + category.id,
                    value: category.id
                });

                var label = $('<label>', {
                    for: 'category_' + category.id,
                    text: category.name,
                    class: 'mx-2'
                });

                // Create a div for each checkbox and label
                var checkboxDiv = $('<div>', { class: 'category-checkbox' }).append(checkbox).append(label);
                
                // Append the checkbox div to the container
                $('#category_div').append(checkboxDiv);
            });

            var sliderContainer = document.getElementById('category-slider');
            categoriesData.forEach(category => {
              const colDiv = document.createElement('div');
              colDiv.classList.add('col-3');

              colDiv.innerHTML = `
                <a href="collections.php?id=${category.id}">
                  <div class="category-circle" style="height: 206px;">
                    <img src="../admin/uploads/categories/${category.image}" alt="${category.name}" style="width: 165px; height: 165px;">
                    <h5>${category.name}</h5>
                  </div>
                </a>
              `;

              sliderContainer.appendChild(colDiv);
            });
            $('#category-slider').marquee({
                duration: 5000,
                duplicated: true,
                gap: 00, 
                direction: 'left',
                pauseOnHover: true
            });

  // Handle 'Next' button click
  $('#next-btn').click(function() {
    sliderContainer.animate({
      scrollLeft: '+=300' // Scroll right by 300px
    }, 500); // 500ms animation duration
  });
        },
    });
  }
  fetchCategories();

  function fetchData(){
        $.ajax({
            type: "POST",
            url: "query_shop/product_query.php",
            data: {},
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                var data = JSON.parse(response);
                var products = data.data
                // Assuming data is an array of cart items
                const container = document.getElementById('productShow').querySelector('.row');
                container.innerHTML = ''
                sno = 0;
                if(products.length > 0){
                      products.forEach(item => {
                         productId = parseInt(item.id, 10);
                         categoryId = parseInt(item.category_id, 10);
                         price = parseInt(item.price, 10);

                        // Push the parsed values into the productsData array
                        productsData.push({
                          id: productId,
                          category_id: categoryId,
                          price: price,
                          name: item.name,
                          image: item.image
                        });
                      const card = document.createElement('div');
                      card.className = 'col-md-3 mb-3';

                      card.innerHTML = `
                          <div class="food-box">
                            <div class="image-container d-flex justify-content-center align-items-center">
                              <img src="../admin/uploads/products/${item.image}" alt="" class="zoom-image center-img-auto mb-3" width="100">
                            </div>
                            <div class="pricess">
                              <h3 class="mb-3">${item.name}</h3>
                              <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 20px;">&#x20B9; ${item.price}</p>
                                <button type="button" class="btn" onclick="addToCart(${item.id})"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                              </div>
                            </div>   
                          </div>
                      `;
                      container.appendChild(card);
                    });
                }else{
                        var row = `<p>No Products</p>`;
                        container.appendChild(row);
                }
                // console.log("productsData")             
                // console.log(productsData)
            },
        });
  }
  fetchData()

  function addToCart(id){
      var checkUs = '<?php echo $checkUser;?>'
      console.log(checkUs)
      if(checkUs == 'no user'){
        Swal.fire({
          // title: "The Internet?",
          text: "Please log in to add this product to your cart",
          icon: "question"
        });
        return false;
      }
      let cart = JSON.parse(localStorage.getItem('cart')) || [];

      // Find the product in the cart
      const productIndex = cart.findIndex(item => item.id === id);

      if (productIndex > -1) {
        // If the product exists, increase its quantity
        cart[productIndex].quantity += 1;
      } else {
        // If the product doesn't exist, add it with quantity 1
        const product = productsData.find(product => product.id === id);
        if (product) {
          cart.push({...product, quantity: 1});
        }
      }

      // Update the cart in local storage
      localStorage.setItem('cart', JSON.stringify(cart));

      // console.log(cart);
      // console.log("Number of items in local storage:", cart.length);
      Swal.fire({
        // title: "The Internet?",
        text: "Added to your cart",
        icon: "success"
      });
     existsProductCount()
  }

    function applyFilter() {
      // Get all checked checkboxes
      const selectedCategories = [];
      const checkboxes = document.querySelectorAll('input[name="category"]:checked');
      
      // Loop through checked checkboxes and store their values
      checkboxes.forEach(function(checkbox) {
        selectedCategories.push(checkbox.value); // Get the label text
      });
      console.log(selectedCategories)
      console.log($("#filter_by_price").val())

      var filterPrice = $("#filter_by_price").val()
      var intArr = selectedCategories.map(value => parseInt(value));
      console.log(productsData)
      var filteredProducts = [];
      if(selectedCategories.length > 0){
        filteredProducts = productsData.filter(product => intArr.includes(product.category_id));
      }else{
        filteredProducts = productsData
      }
      
      // console.log(filteredProducts)

      if (filterPrice === "low to high") {
        // Sort products by price in ascending order
        filteredProducts = filteredProducts.sort((a, b) => a.price - b.price);
        // console.log("Filtered and sorted by price (low to high):", filteredProducts);
      } else if (filterPrice === "high to low") {
        // Sort products by price in descending order
        filteredProducts = filteredProducts.sort((a, b) => b.price - a.price);
        // console.log("Filtered and sorted by price (high to low):", filteredProducts);
      } else {
        // If filterPrice is "", don't apply any price sorting
        // console.log("No price sorting applied:", filteredProducts);
      }
      const container = document.getElementById('productShow').querySelector('.row');
      container.innerHTML = "";
      filteredProducts.forEach(item => {
        const card = document.createElement('div');
        card.className = 'col-md-3 mb-3';

        card.innerHTML = `
            <div class="food-box">
              <div class="image-container d-flex justify-content-center align-items-center">
                <img src="../admin/uploads/products/${item.image}" alt="" class="zoom-image center-img-auto mb-3" width="100">
              </div>
              <div class="pricess">
                <h3 class="mb-3">${item.name}</h3>
                <div class="d-flex justify-content-between align-items-center">
                  <p style="font-size: 22px;">&#x20B9; ${item.price}</p>
                  <button type="button" class="btn" onclick="addToCart(${item.id})"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
              </div>   
            </div>
        `;
        container.appendChild(card);
      });
    // Display filtered products
    // Display the selected categories
    // const displayElement = document.getElementById('selectedCategories');
    // if (selectedCategories.length > 0) {
    //   displayElement.innerHTML = 'Selected Categories: ' + selectedCategories.join(', ');
    // } else {
    //   displayElement.innerHTML = 'No categories selected.';
    // }
  }
  // Function to handle "Clear" button click
  function clearSelection() {
    // Uncheck all checkboxes
    const checkboxes = document.querySelectorAll('input[name="category"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = false;
    });
    productsData = []
    fetchData()

    // Clear the selected categories display
    // document.getElementById('selectedCategories').innerHTML = 'No categories selected.';
  }

</script>