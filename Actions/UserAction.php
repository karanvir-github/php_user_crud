<?php
require_once "../Managers/UserMgr.php";
require_once "../BusinessObjects/User.php";

$call = "";
if (isset($_GET["call"])) {
    $call = $_GET["call"];
} else {
    $call = $_POST["call"];
}

$userMgr = new UserMgr();
$userObj = new User();

if ($call == "getDataByPage") {
    $page = $_GET["pageNumber"];
    $data = $userMgr->getDataByPage($page);
    $response = new ArrayObject();
    $response["success"] =  1;
    $response["emps"] = $data;
    echo json_encode($response);
}

if ($call == "addNewEmployeeWithForm") {
    $userObj->setFirstname(($_POST["firstname"]));
    $userObj->setLastname(($_POST["lastname"]));
    $userObj->setEmail(($_POST["email"]));
    $userObj->setDob(($_POST["dob"]));
    $bool = $userMgr->insertUser($userObj);
    if ($bool == 1) {
        $response["success"] = 1;
        $response["name"] = $_POST["firstname"];
        echo json_encode($response);
    }
}
