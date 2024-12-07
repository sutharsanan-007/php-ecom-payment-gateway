<?php require("../header.php");?>
<style>
    table {
        table-layout: fixed;
        width: 100%;
        word-break: break-all;
    }
    thead th {
        border: 1px solid #ddd; /* Border for table headers */
        padding: 10px; /* Padding for table headers */
        background-color: #f2f2f2; /* Background color for header */
        text-align: left; /* Align text to the left */
    }

    /* Table cell styling */
    tbody td {
        border: 1px solid #ddd; /* Border for table cells */
        padding: 10px; /* Padding for table cells */
    }

    /* Optional: Hover effect for table rows */
    tbody tr:hover {
        background-color: #f1f1f1; /* Change background on hover */
    }
</style>
<div class="container rounded bg-white p-5">
      <h3>Users</h3>
        <div class="d-flex justify-content-between align-items-center">
            <div class="form-group">
                <label class="" for="name">Subject</label>
                <input type="text" class="form-control" id="subject_name">
            </div>
            <div class="form-group">
                <label class="" for="price">Body content</label>
                <textarea  class="form-control"  id="body_content"></textarea>
            </div>
            <div class="form-group">
                <label class="" for="image">Image</label>
                <input type="file" class="form-control" id="image">
            </div>    
            <button type="button" class="btn btn-primary mb-3"  onclick="mailModal()"><i class="fas fa-envelope-open-text"></i> Send Mail</button>
        <!-- data-toggle="modal" data-target="#mailModal" -->
    </div>
    <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="onSubmit()">Send</button>
                </div>
            </div>
        </div>
    </div>
    <table id="cartTable">
        <thead>
            <th width="5%"><input type="checkbox" name="" id="selectAll"> All</th>
            <th width="5%">Sno</th>
            <th width="20%">Name</th>
            <th width="25%">Email</th>
            <th width="20%">Phone Number</th>
            <th width="25%">Address</th>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
<?php require("../footer.php");?>
<script>
    $(document).ready(function () {
        $("#breadcrumb-title").html("Users")
        $("#breadcrumb-title-sub").html("Users")
        $('#selectAll').change(function() {
            var isChecked = $(this).prop('checked');
            $(".userCheckbox").prop('checked', isChecked); // Select all checkboxes
        });
    });
    function mailModal(){
        var checkedCount = $(".userCheckbox:checked").length;
        if(checkedCount > 0){
            // $("#mailModal").modal('show')
            onSubmit()
        }else{
            Swal.fire({
                  // title: "The Internet?",
                text: 'Please select users',
                icon: 'error'
            });
        }
    }
    function closeModal(){
        $("#mailModal").modal('hide')
    }
    function fetchUsers(){
         $.ajax({
            type: "POST",
            url: "../query_admin/fetch_users.php",
            data: {},
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                var tbody = $('#cartTable tbody');
                tbody.empty(); // Clear existing rows
                var usersDetails = data.user
                // Assuming data is an array of cart items
                sno = 0;
                usersDetails.forEach(function(item) {
                    sno++;
                    var row = `<tr>
                        <td width="3%"><input type="checkbox" class="userCheckbox" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-phone="${item.phone_number}" data-address="${item.address}"></td>
                        <td width="3%">${sno}</td>
                        <td width="10%">${item.name}</td>
                        <td>${item.email}</td>
                        <td width="10%">${item.phone_number}</td>
                        <td style="word-wrap: break-word;">${item.address}</td>
                        <td></td>
                    </tr>`;
                    tbody.append(row);
                });
            },
        })
    }
    fetchUsers()

    function onSubmit(){
         $(".form-control").removeClass('border-bottom border-danger');
        validation = 0
        
        var subject_name = $("#subject_name").val()
        var body_content = $("#body_content").val().trim();
        var image = $("#image")[0].files[0];
        // var arrEmail = [];
        var emailString = "";
        var selectedData = [];
     
        // console.log(checkedCount + ' checkedCount');
        $(".userCheckbox:checked").each(function() {
            var user = {
                id: $(this).data('id'),
                name: $(this).data('name'),
                email: $(this).data('email'),
                phone: $(this).data('phone'),
                address: $(this).data('address')
            };
            // selectedData.push(user);
            // arrEmail.push($(this).data('email')); 
            var email = $(this).data('email');  // Get the email from the data attribute
            if (email) {  // Check if there's a valid email
                emailString += email + ";";  // Append email with a semicolon
            }
        });

        // Remove the last semicolon
        emailString = emailString.slice(0, -1);

        console.log(emailString);

        
        if(subject_name == ""){
            $("#subject_name").addClass('border-bottom border-danger');
            validation = 1
        }
        if(body_content == ""){
            $("#body_content").addClass('border-bottom border-danger');
            validation = 1
        }
        if(!image){
            $("#image").addClass('border-bottom border-danger');
            validation = 1
        }
        if(validation == 1){
            return false;
        }
        const formData = new FormData();
        formData.append("user_data", emailString);
        formData.append("subject_name", subject_name);
        formData.append("body_content", body_content);
        formData.append("file", image);

        $.ajax({
            type: "post",
            url: "../query_admin/email/sendMail.php",
            data: formData,
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                Swal.fire({
                  // title: "The Internet?",
                  text: data.message,
                  icon: data.event
                });
                closeModal()
            }
        });
    }
</script>