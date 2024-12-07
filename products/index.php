<?php require("../header.php");?>
    <div class="container rounded bg-white p-5">
        <div class="d-flex justify-content-between">
            <h3>Products Details</h3>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add Product</button>
        </div>
        <!-- add products model start -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="" for="name">Category Name</label>
                                <select class="form-control" id="category_name">
                                    <!-- option appen using jquery ajax method -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="" for="name">Product Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label class="" for="image">Image</label>
                                <input type="file" class="form-control" id="image">
                            </div>
                            <div class="form-group">
                                <label class="" for="price">Price</label>
                                <input type="number" class="form-control" id="price">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="onSubmit()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
          <!-- update product model start -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="upd_id">
                            <div class="form-group">
                                <label class="" for="name">Category Name</label>
                                <select class="form-control" id="upd_category_name">
                                    <!-- option appen using jquery ajax method -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="" for="upd_name">Product Name</label>
                                <input type="text" class="form-control" id="upd_name">
                            </div>
                            <div class="form-group">
                                <label class="" for="upd_image">Image</label>
                                <input type="file" class="form-control" id="upd_image">
                            </div>
                               <div class="form-group">
                                <label class="" for="upd_price">Price</label>
                                <input type="number" class="form-control" id="upd_price">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="onUpdate()">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
          <!-- delete product model start -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="del_id">
                        <p>Did you want to delete <span id="del_name_show"></span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="onDelete()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <div class="table-responsive">
            <table id="myTable" class="table">
                <thead>
                    <th>Sno</th>
                    <th>Category Name</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <!-- Rows will be appended here -->
                </tbody>
            </table>
        </div>
 
    </div>
<?php require("../footer.php");?>
<script>
    var categoriesData;
    $(document).ready(function () {
        $("#breadcrumb-title").html("Products")
        $("#breadcrumb-title-sub").html("Products Details")    
    });
     function fetchCategories(){
        $.ajax({
            type: "POST",
            url: "../query_admin/categories/view.php",
            data: {},
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                console.log(data)
                $('#category_name').empty();

                // Add a default 'Select' option
                $('#category_name').append('<option value="">Select a Category</option>');
                categoriesData = data.data
                // Loop through categories and create option elements
                $.each(categoriesData, function(index, category) {
                    var option = $('<option></option>').val(category.id).text(category.name);
                    $('#category_name').append(option);
                });
             
            },
        });
    }
    fetchCategories()
    function fetchData(){
        $.ajax({
            type: "POST",
            url: "../query_admin/products/view.php",
            data: {},
            processData: false, // Important for FormData
            contentType: false, // Important for FormData
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                console.log(data)
                var tbody = $('#myTable tbody');
                tbody.empty(); // Clear existing rows
                var tableData = data.data
                // Assuming data is an array of cart items
                sno = 0;
                if(tableData.length > 0){
                    tableData.forEach(function(item) {
                        sno++;
                        var row = `<tr>
                            <td>${sno}</td>
                            <td>${item.category_name}</td>
                            <td><img src="../uploads/products/${item.image}" width="100px"></td>
                            <td>${item.name}</td>
                            <td>${item.price}</td>
                            <td><button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#updateModal" onclick="fetchUpdate(${item.id},'${item.category_id}','${item.name}',${item.price})"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#deleteModal" onclick="fetchDelete(${item.id},'${item.name}')"><i class="fas fa-trash"></i> </button></td>
                        </tr>`;
                        tbody.append(row);
                    });
                }else{
                        var row = `<tr>
                            <td>No Records</td>
                        </tr>`;
                        tbody.append(row);
                }
             
            },
        });
    }
    fetchData()
    function onSubmit(){
        $(".form-control").removeClass('border-bottom border-danger');
        validation = 0
        var category_name = $("#category_name").val()
        var name = $("#name").val().trim();
        var image = $("#image")[0].files[0];
        var price = $("#price").val().trim();

        if(category_name == ""){
            $("#category_name").addClass('border-bottom border-danger');
            validation = 1
        }
        if(name == ""){
            $("#name").addClass('border-bottom border-danger');
            validation = 1
        }
        if(!image){
            $("#image").addClass('border-bottom border-danger');
            validation = 1
        }
        if(price == ""){
            $("#price").addClass('border-bottom border-danger');
            validation = 1
        }
        if(validation == 1){
            return false;
        }
        const formData = new FormData();
        formData.append("category_id", category_name);
        formData.append("name", name);
        formData.append("file", image);
        formData.append("price", price);

        $.ajax({
            type: "post",
            url: "../query_admin/products/add.php",
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
                $("#addModal").modal('hide');
                fetchData()
            }
        });
    }
    function fetchUpdate(id,category_id,name,price){
        $("#upd_id").val(id)
        $("#upd_name").val(name)
        $("#upd_price").val(price)

        $('#upd_category_name').empty();

        // Add a default 'Select' option
        $('#upd_category_name').append('<option value="">Select a Category</option>');
        // Loop through categories and create option elements
        $.each(categoriesData, function(index, category) {
            // Create option element
            var option = $('<option></option>').val(category.id).text(category.name);

            // If category.id matches category_id, mark it as selected
            if (category.id == category_id) {
                option.prop('selected', true); // Set the selected option
            }

            // Append the option to the dropdown
            $('#upd_category_name').append(option);
        });
    }
    function onUpdate(){
        $(".form-control").removeClass('border-bottom border-danger');
        validation = 0
        var id = $("#upd_id").val()
        var name = $("#upd_name").val().trim();
        var image = $("#upd_image")[0].files[0];
        var category_id = $("#upd_category_name").val()
        var price = $("#upd_price").val()

        if(name == ""){
            $("#upd_name").addClass('border-bottom border-danger');
            validation = 1
        }
        if(category_id == ""){
            $("#upd_category_name").addClass('border-bottom border-danger');
            validation = 1
        }
        if(price == ""){
            $("#upd_price").addClass('border-bottom border-danger');
            validation = 1
        }

        if(validation == 1){
            return false;
        }

        const formData = new FormData();
        formData.append("id", id);
        formData.append("category_id", category_id);
        formData.append("name", name);
        formData.append("file", image);
        formData.append("price", price);

        $.ajax({
            type: "post",
            url: "../query_admin/products/update.php",
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
                $("#updateModal").modal('hide');
                fetchData()
            }
        });
    }
    function fetchDelete(id,name){
        $("#del_id").val(id)
        // $("#del_name").val(name)
        $("#del_name_show").html(name)
    }
    function onDelete(){

        var id = $("#del_id").val()
        
        const formData = new FormData();
        formData.append("id", id);

        $.ajax({
            type: "post",
            url: "../query_admin/products/delete.php",
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
                $("#deleteModal").modal('hide');
                fetchData()
            }
        });
    }
</script>