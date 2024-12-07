<?php
session_start();
if(isset($_SESSION['role']) && $_SESSION['role'] == 2){
    header("Location: index.php");
}
?>
<?php require('header.php');?>
<section class="main-content page-content">
 <div class="container">
  <div class="containers">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="#">
        <input type="text" name="email" id="email" class="form-validation" placeholder="Enter your email">
        <input type="password" name="pwd" id="pwd" class="form-validation" placeholder="Enter your password">
        <!-- <a href="#">Forgot password?</a> -->
        <input type="button" class="button" value="Login" onclick="onSubmit()">
      </form>
      <div class="signup">
        <p>Don't you have an account?</p>
        <a href="register.php">Register</a>
      </div>
    </div>
  </div>
   </div>
</section>
<?php require('footer.php');?>
<script>
    function resetFormValue(){
        $("#email").val("")
        $("#pwd").val("")
    }
    function onSubmit() {
        // Clear previous error styles
        $(".form-validation").removeClass('border border-danger');

        var email = $("#email").val().trim();
        var pwd = $("#pwd").val().trim();

        // Basic validation
        let validation = false;

        if (email === "") {
            $("#email").addClass("border border-danger");
            validation = true;
        }
        if (pwd === "") {
            $("#pwd").addClass("border border-danger");
            validation = true;
        }

        // If validation fails, return
        if (validation) {
            return false;
        }

        // Create FormData object
        const formData = new FormData();
        formData.append("email", email);
        formData.append("password", pwd);

        // AJAX request
        $.ajax({
            type: "POST",
            url: "query_shop/login_query.php",
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                Swal.fire({
                  // title: "The Internet?",
                  text: data.message,
                  icon: data.event
                });
                if(data.event == 'success'){
                  resetFormValue()
                  setTimeout(() => {
                    window.location.href = 'index.php';
                  }, 1500);
                }
            },
        });
    }

    function clearCart() {
      localStorage.removeItem('cart');
    }
    clearCart();
</script>