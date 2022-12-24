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
                            <a href="index.php" style="color:#fff !important;">
                                <h2>Manage <b>Employees</b></h2>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <a href="javascript:deleteEmployee('selected')" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 ml-2">
                    <form method="GET" id="searchForm">
                        <div class="form-row">
                            <div class="col-10">
                                <input type="text" name="searchData" id="searchData" class="form-control">
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-info" value="Search">
                            </div>
                        </div>
                    </form>
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
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeRecordTbl">
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b id="visibleEntries">5</b> out of <b id="seeTotalEntries"></b> entries</div>
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
                            <input type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add" id="addEmployeeSubmitBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editEmployeeForm" method="POST">
                    <input type="hidden" id="empid" name="id">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control">
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
                <form id="deleteEmployeeForm" method="POST">
                    <input type="hidden" name="id[]" id="empid">
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
        addPageNumbers()
        getDataByPage(1)
    });
    const employeeBulkIds = new Set();
    $("#selectAll").click(function() {
        var checkbox = $('table tbody input[type="checkbox"]');
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true
                employeeBulkIds.add(this.value);
            });
        } else {
            checkbox.each(function() {
                this.checked = false
                employeeBulkIds.delete(this.value);
            });
        }
    })

    function getCheckedValues() {
        var checkbox = $('table tbody input[type="checkbox"]');
        checkbox.each(function() {
            if (this.checked) {
                employeeBulkIds.add(this.value);
            } else {
                employeeBulkIds.delete(this.value);
            }
        })
    }

    function getTotalRowsToAddPageNumbers() {
        url = "Actions/EmployeeAction.php?call=getTotalRowsInDb";
        $.ajax({
            url: url,
            type: 'GET',
            async: false,
            success: function(data) {
                data = JSON.parse(data);
                rows = data.totalRows;
            }
        })
        return rows;
    }
    totalRows = getTotalRowsToAddPageNumbers();

    function addPageNumbers(pageNum = null) {
        pageNum = pageNum != null ? pageNum : 1;
        subCondition = pageNum
        totalPageNumberstoBuild = 10
        // totalPageNumbertoBuild = Math.ceil(totalRows / 5)
        $(".pagination").each(function() {
            $(".pagination").html('');
            if (subCondition < totalPageNumberstoBuild) {
                if (totalPageNumberstoBuild > 5) {
                    subCondition += 4
                } else {
                    subCondition = totalPageNumberstoBuild
                }
                if (subCondition > 5) {
                    getLastPages = pageNum - 5
                    $(".pagination").append('<li class="page-item"><a href="javascript:addPageNumbers(' + getLastPages + ')" class="page-link">Previous</a></li>');
                }
                while (pageNum <= subCondition) {
                    $(".pagination").append('<li class="page-item"><a href="javascript:getDataByPage(' + pageNum + ')" class="page-link">' + pageNum + '</a></li>');
                    pageNum += 1
                }
                if (pageNum < totalPageNumberstoBuild) {
                    $(".pagination").append('<li class="page-item"><a href="javascript:addPageNumbers(' + pageNum + ')" class="page-link">Next</a></li>');
                } else {
                    $(".pagination").append('<li class="page-item"><a class="page-link">No More Pages</a></li>');
                }
            }
        });
    }

    lastfetchedId = 0

    // get data by page
    function getDataByPage(page) {
        url = "Actions/EmployeeAction.php?call=getDataByPage&pageNumber=" + page + "&lastFetchedID=" + lastfetchedId;
        $.getJSON(url, function(data) {
            let html = "";
            $("#employeeRecordTbl").html(html);
            $.each(data.emps, function(key, value) {
                $("#seeTotalEntries").html(data.totalEntries)
                lastfetchedId = data.lastID
                html = "<tr>";
                html += "<td><span class='custom-checkbox'><input type='checkbox' onClick='getCheckedValues()' value='" + value.id + "'><label for='checkbox'></label></span></td>";
                html += "<td>" + value.id + "</td>";
                html += "<td>" + value.firstname + "</td>";
                html += "<td>" + value.lastname + "</td>";
                html += "<td>" + value.email + "</td>";
                html += "<td>" + value.dob + "";
                html += "<td>";
                html += "<a onclick='javascript:editEmployee(" + value.id + ")' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit' style='cursor:pointer !important'>&#xE254;</i></a>";
                html += "<a onclick='javascript:deleteEmployee(" + value.id + ")' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete' style='cursor:pointer !important'>&#xE872;</i></a>";
                html += "</td>";
                html += "</tr>";
                $("#employeeRecordTbl").append(html);
            });
        });
    }

    function verifyDataBeforeSubmit(formId) {
        let firstname = $(formId + " #firstname").val();
        let lastname = $(formId + " #lastname").val();
        let email = $(formId + " #email").val();
        let dob = $(formId + " #dob").val();
        if (firstname != '' && lastname != '' && email != '' && dob != '') {
            return 1;
        } else {
            alert("All fields are mandatory !!");
            return 0;
        }
    }

    $('#addEmployeeSubmitBtn').click(function(e) {
        e.preventDefault();
        let verified = 0
        let formId = "#addEmployeeForm"
        verified = verifyDataBeforeSubmit(formId);
        if (verified === 1) {
            let serializedForm = $("#addEmployeeForm").serialize();
            url = "Actions/EmployeeAction.php?call=addNewEmployeeWithForm&formData=" + serializedForm
            $.ajax({
                type: "POST",
                url: url,
                data: serializedForm,
                async: false, // to wait until get response from Action
                success: function(result) {
                    result = $.parseJSON(result);
                    if (result.success === 1) {
                        $("#addEmployeeModal").hide();
                        window.location.reload();
                    }
                }
            })
        }
    });

    function editEmployee(id) {
        url = "Actions/EmployeeAction.php?call=getEmployeeById&id=" + id;
        $.getJSON(url, function(data) {
            if (data.success === 1) {
                $("#editEmployeeForm #empid").val(data.emp.id);
                $("#editEmployeeForm #firstname").val(data.emp.firstname);
                $("#editEmployeeForm #lastname").val(data.emp.lastname);
                $("#editEmployeeForm #email").val(data.emp.email);
                $("#editEmployeeForm #dob").val(data.emp.dob);
                $("#editEmployeeModal").modal('show');
            }
        })
    }

    $('#editEmployeeForm').submit(function(e) {
        e.preventDefault();
        let formId = "#editEmployeeForm"
        verified = verifyDataBeforeSubmit(formId);
        if (verified === 1) {
            let serializedForm = $("#editEmployeeForm").serialize();
            url = "Actions/EmployeeAction.php?call=updateEmployeeWithId&formData=" + serializedForm;
            $.ajax({
                type: "POST",
                url: url,
                data: serializedForm,
                async: false, // to wait until get response from Action
                success: function(result) {
                    result = $.parseJSON(result);
                    if (result.success === 1) {
                        $("#editEmployeeModal").modal('hide');
                        window.location.reload();
                    }
                }
            })
        }
    });

    function deleteEmployee(id) {
        $("#deleteEmployeeModal").modal('show');
        $("#deleteEmployeeForm #empid").val(id);
    }

    $("#deleteEmployeeForm").submit(function(e) {
        e.preventDefault(e);
        let id = $("#deleteEmployeeForm #empid").val();
        if (id == "selected") {
            deleteSelectedEmps();
        }
        url = "Actions/EmployeeAction.php?call=deleteEmployee&id=" + id;
        $.getJSON(url).then(function(response) {
            if (response.success === 1) {
                window.location.reload();
            }
        })
    })

    function deleteSelectedEmps() {
        let ids = []
        employeeBulkIds.forEach(function(value) {
            ids.push(value)
        })
        if (ids == "") {
            alert("Please select at least one employee")
            window.location.reload();
        }
        url = "Actions/EmployeeAction.php?call=deleteSelectedEmployees&ids=" + ids;
        $.getJSON(url).then(function(response) {
            if (response.success === 1) {
                window.location.reload();
            }
        })
    }

    $("#searchForm").submit(function(e) {
        e.preventDefault();
        let searchData = $("#searchData").val();
        if (searchData == "" || searchData == null) {
            alert("Please enter some data to search")
        } else {
            url = "Actions/EmployeeAction.php?call=searchEmployee&searchSlug=" + searchData
            $.getJSON(url, function(data) {
                if (data.success === 1) {
                    $(".pagination").html('')
                    searchData.replace(searchData, '<b>' + searchData + '</b>');
                    let html = "";
                    $("#employeeRecordTbl").html(html);
                    $.each(data.emps, function(key, value) {
                        $(".hint-text").html(data.totalEntries + ' entries found in the search result')
                        lastfetchedId = data.lastID
                        html = "<tr>";
                        html += "<td><span class='custom-checkbox'><input type='checkbox' onClick='getCheckedValues()' value='" + value.id + "'><label for='checkbox'></label></span></td>";
                        html += "<td>" + value.id + "</td>";
                        html += "<td>" + value.firstname + "</td>";
                        html += "<td>" + value.lastname + "</td>";
                        html += "<td>" + value.email + "</td>";
                        html += "<td>" + value.dob + "";
                        html += "<td>";
                        html += "<a onclick='javascript:editEmployee(" + value.id + ")' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit' style='cursor:pointer !important'>&#xE254;</i></a>";
                        html += "<a onclick='javascript:deleteEmployee(" + value.id + ")' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete' style='cursor:pointer !important'>&#xE872;</i></a>";
                        html += "</td>";
                        html += "</tr>";
                        $("#employeeRecordTbl").append(html);
                    });
                }
            })
        }
    })
</script>