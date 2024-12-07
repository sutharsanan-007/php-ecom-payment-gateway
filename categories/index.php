<?php require("../header.php");?>
    <div class="container rounded bg-white p-5">
        <div class="d-flex justify-content-between">
            <h3>Categories Details</h3>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add Category</button>
        </div>
        <!-- add category model start -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="" for="name">Category Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label class="" for="image">Image</label>
                                <input type="file" class="form-control" id="image">
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
          <!-- update category model start -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="upd_id">
                            <div class="form-group">
                                <label class="" for="name">Category Name</label>
                                <input type="text" class="form-control" id="upd_name">
                            </div>
                            <div class="form-group">
                                <label class="" for="image">Image</label>
                                <input type="file" class="form-control" id="upd_image">
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
          <!-- delete category model start -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
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
        <table id="myTable" class="table">
            <thead>
                <th>Sno</th>
                <th>Category Image</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                <!-- Rows will be appended here -->
            </tbody>
        </table>
    </div>
<?php require("../footer.php");?>
<script>
    $(document).ready(function () {
        $("#breadcrumb-title").html("Categories")
        $("#breadcrumb-title-sub").html("Categories Details")    
    });
    function fetchData(){
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
                            <td><img src="../uploads/categories/${item.image}" width="100px"></td>
                            <td>${item.name}</td>
                            <td><button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#updateModal" onclick="fetchUpdate(${item.id},'${item.name}')"><i class="fas fa-pen"></i></button> <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#deleteModal" onclick="fetchDelete(${item.id},'${item.name}')"><i class="fas fa-trash"></i> </button></td>
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
        var name = $("#name").val().trim();
        var image = $("#image")[0].files[0];

        if(name == ""){
            $("#name").addClass('border-bottom border-danger');
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
        formData.append("name", name);
        formData.append("file", image);

        $.ajax({
            type: "post",
            url: "../query_admin/categories/add.php",
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
    function fetchUpdate(id,name){
        $("#upd_id").val(id)
        $("#upd_name").val(name)
    }
    function onUpdate(){
        $(".form-control").removeClass('border-bottom border-danger');
        validation = 0
        var id = $("#upd_id").val()
        var name = $("#upd_name").val().trim();
        var image = $("#upd_image")[0].files[0];

        if(name == ""){
            $("#name").addClass('border-bottom border-danger');
            validation = 1
        }

        if(validation == 1){
            return false;
        }
        const formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("file", image);

        $.ajax({
            type: "post",
            url: "../query_admin/categories/update.php",
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
            url: "../query_admin/categories/delete.php",
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