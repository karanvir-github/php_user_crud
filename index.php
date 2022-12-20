<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "includes/cdns.php";
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee CRUD</title>
    <link rel="stylesheet" href="includes/index.css" type="text/css">

</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Employees</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <!-- Employee Alert -->
                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="employeeAlert">
                    <strong>Success !</strong> <i id="conditionalStmtHere"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>DOB</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeRecordTbl">

                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addEmployeeForm" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add" onclick="submitAddEmployeeForm()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $("#employeeAlert").hide();
        $('[data-toggle="tooltip"]').tooltip();
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
        addPageNumbers()
        getDataByPage(1)
    });

    function addPageNumbers() {
        $(".pagination").each(function() {
            $(".pagination").append('<li class="page-item"><a href="#" class="page-link">Previous</a></li>');
            num = 1;
            while (num <= 5) {
                $(".pagination").append('<li class="page-item"><a href="javascript:getDataByPage(' + num + ')" class="page-link">' + num + '</a></li>');
                num += 1
            }
            $(".pagination").append('<li class="page-item"><a href="#" class="page-link">Next</a></li>');
        });
    }
    // get data by page
    function getDataByPage(page) {
        url = "Actions/UserAction.php?call=getDataByPage&pageNumber=" + page;
        $.getJSON(url, function(data) {
            let html = "";
            $("#employeeRecordTbl").html(html);
            $.each(data.emps, function(key, value) {
                html = "<tr>";
                html += "<td><span class='custom-checkbox'><input type='checkbox' id='" + key + "' name='options[]' value='" + key + "'><label for='" + key + "'></label></span></td>";
                html += "<td>" + value.firstname + "--" + value.id + "</td>";
                html += "<td>" + value.lastname + "</td>";
                html += "<td>" + value.email + "</td>";
                html += "<td>" + value.dob + "";
                html += "<td>";
                html += "<a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
                html += "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>";
                html += "</td>";
                html += "</tr>";
                $("#employeeRecordTbl").append(html);
            });
        });
    }

    function submitAddEmployeeForm() {
        let serializedForm = $("#addEmployeeForm").serialize();
        url = "Actions/UserAction.php?call=addNewEmployeeWithForm&formDara=" + serializedForm
        $.ajax({
            type: "POST",
            url: url,
            data: serializedForm,
            async: false, // to wait until get response from Action
            success: function(result) {
                result = $.parseJSON(result);
                if (result.success == 1) {
                    $("#addEmployeeModal").hide();
                    $("#employeeAlert #conditionalStmtHere").html("A new employee named <b>" + result.name + "</b> has been added to the Database")
                    $("#employeeAlert").show()
                }
            }
        })
    }
</script>