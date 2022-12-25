<?php
require_once "../Managers/EmpMgr.php";
require_once "../BusinessObjects/Emp.php";

$call = "";
if (isset($_GET["call"])) {
    $call = $_GET["call"];
} else {
    $call = $_POST["call"];
}

$employeeMgr = new EmpMgr();
$employeeObj = new Employee();

if ($call == "getDataByPage") {
    $pageToServe = $_GET["pageToServe"];
    $lastPageServed = $_GET["lastPageServed"];
    $conditionalData = $employeeMgr->getDataByPage($pageToServe, $lastPageServed);
    $response["success"] =  1;
    if ($conditionalData["data"] == NULL) {
        $response["emps"] = "";
    } else {
        $response["emps"] = $conditionalData["data"];
        $response["totalEntries"] = $conditionalData["rows"];
        $response["lastPageServed"] = $conditionalData["lastPageServed"];
    }
    echo json_encode($response);
}

if ($call == "addNewEmployeeWithForm") {
    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : NULL;
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : NULL;
    $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : NULL;
    $employeeObj->setFirstname($firstname);
    $employeeObj->setLastname($lastname);
    $employeeObj->setEmail($email);
    $employeeObj->setDob($dob);
    $bool = $employeeMgr->insertEmployee($employeeObj);
    if ($bool == 1) {
        $response["success"] = 1;
        $response["name"] = $firstname;
        echo json_encode($response);
    }
}

if ($call == "getEmployeeById") {
    $id = $_GET["id"];
    $employee = $employeeMgr->getEmployeeById($id);
    if ($employee) {
        $response["success"] = 1;
        $response["emp"] = $employee[0];
        echo json_encode($response);
    }
}

if ($call == "updateEmployeeWithId") {
    $id = $_POST["id"];
    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : NULL;
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : NULL;
    $email = isset($_POST["email"]) ? $_POST["email"] : NULL;
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : NULL;
    $employeeObj->setFirstname($firstname);
    $employeeObj->setLastname($lastname);
    $employeeObj->setEmail($email);
    $employeeObj->setDob($dob);
    $bool = $employeeMgr->updateEmployeeById($employeeObj, $id);
    if ($bool === 1) {
        $response["success"] = 1;
        echo json_encode($response);
    }
}

if ($call == "deleteEmployee") {
    $id = $_GET["id"];
    $res = $employeeMgr->deleteEmployee($id);
    if ($res === 1) {
        $response["success"] = 1;
        echo json_encode($response);
    }
}

if ($call == "deleteSelectedEmployees") {
    $ids = $_GET["ids"];
    $res = $employeeMgr->deleteSelectedEmployees($ids);
    if ($res === 1) {
        $response["success"] = 1;
        echo json_encode($response);
    }
}

if ($call == "getTotalRowsInDb") {
    $res = $employeeMgr->getTotalRowsInDb($call);
    $response["totalRows"] = $res;
    echo json_encode($response);
}

if ($call == "searchEmployeeWithFilter") {
    $searchSlug = $_GET["searchSlug"];
    $condition = $_GET["condition"];
    $res = $employeeMgr->searchEmployeeWithFilter($searchSlug, $condition);
    $response["success"] = 1;
    if ($res == NULL) {
        $response["emps"] = "";
    } else {
        $response["emps"] = $res;
        $response["totalEntries"] = count($res);
    }
    echo json_encode($response);
}

if ($call == "searchEmployee") {
    $searchSlug = $_GET["searchSlug"];
    $res = $employeeMgr->searchEmployee($searchSlug);
    $response["success"] = 1;
    if ($res == NULL) {
        $response["emps"] = "";
    } else {
        $response["emps"] = $res;
        $response["totalEntries"] = count($res);
    }
    echo json_encode($response);
}
