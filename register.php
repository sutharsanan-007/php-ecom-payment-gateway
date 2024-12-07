<?php require('header.php'); ?>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
<section class="main-content page-content">
    <div class="container">
        <div class="containers">
            <input type="checkbox" id="check">
            <div class="login form">
                <header>Register</header>
                <form id="registrationForm" onsubmit="return false;">
                    <input type="text" name="name" id="name" placeholder="Enter your name" class="form-validation" required>
                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-validation" required>
                    <input type="password" name="pwd" id="pwd" placeholder="Enter your password" class="form-validation" required>
                    <input type="text" name="number" id="number" placeholder="Enter your number" class="form-validation" required maxlength="10" oninput="validateInput(this)">
                    <textarea name="address" id="address" placeholder="Enter your address" class="form-validation" required></textarea>
                    <input type="button" class="button" value="Register" onclick="onSubmit()">
                </form>
                <div class="signup">
                    <p>Do you have an account?</p>
                    <a href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require('footer.php'); ?>

<script>
    function resetFormValue(){
        $("#name").val("")
        $("#email").val("")
        $("#pwd").val("")
        $("#number").val("")
        $("#address").val("")
    }
    function validateInput(input) {
        input.value = input.value.replace(/[^0-9]/g, '');

        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    }
    function onSubmit() {
        // Clear previous error styles
        $(".form-validation").removeClass('border border-danger');

        // Get values
        var name = $("#name").val().trim();
        var email = $("#email").val().trim();
        var pwd = $("#pwd").val().trim();
        var number = $("#number").val().trim();
        var address = $("#address").val().trim();

        // Basic validation
        let validation = false;

        if (name === "") {
            $("#name").addClass("border border-danger");
            validation = true;
        }
        if (email === "") {
            $("#email").addClass("border border-danger");
            validation = true;
        }
        if (pwd === "") {
            $("#pwd").addClass("border border-danger");
            validation = true;
        }
        if (number === "") {
            $("#number").addClass("border border-danger");
            validation = true;
        }
        if (address === "") {
            $("#address").addClass("border border-danger");
            validation = true;
        }

        // If validation fails, return
        if (validation) {
            return false;
        }

        // Create FormData object
        const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        formData.append("password", pwd);
        formData.append("number", number);
        formData.append("address", address);

        // AJAX request
        $.ajax({
            type: "POST",
            url: "query_shop/register_query.php",
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
                }
            },
        });
    }
</script>
