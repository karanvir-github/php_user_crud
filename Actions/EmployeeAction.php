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
    $page = $_GET["pageNumber"];
    $data = $employeeMgr->getDataByPage($page);
    $response = new ArrayObject();
    $response["success"] =  1;
    $response["emps"] = $data;
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
