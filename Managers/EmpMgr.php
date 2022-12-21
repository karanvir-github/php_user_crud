<?php
require_once "../DB/dbconfig.php";


class EmpMgr
{
    public function getEmpDB()
    {
        $empDB = new DB();
        $empDB = $empDB->connection();
        return $empDB;
    }

    public function insertEmployee($emp)
    {
        try {
            $firstname = $emp->getFirstname();
            $lastname = $emp->getLastname();
            $email = $emp->getEmail();
            $dob = $emp->getDob();
            $sql = "insert into emps (firstname,lastname,email, dob) values ('$firstname','$lastname','$email','$dob')";
            $res = self::getEmpDB()->exec($sql);
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        return $res;
    }

    public function getDataByPage($page)
    {
        $getDataFrom = $page > 1 ? ($page * 5) : 1;
        $sql = "Select * from emps where id >'.$getDataFrom.'order by id DESC limit 5";
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $conditionalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
        return $conditionalData;
    }

    public function getEmployeeById($id)
    {
        $sql = "select * from emps where id = '$id'";
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $employeeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
        return $employeeData;
    }

    public function updateEmployeeById($empObj, $id)
    {
        try {
            $firstname = $empObj->getFirstname();
            $lastname = $empObj->getLastname();
            $email = $empObj->getEmail();
            $dob = $empObj->getDob();
            $sql = "update emps set firstname ='$firstname', lastname ='$lastname', email ='$email', dob ='$dob' where id=$id";
            $res = self::getEmpDB()->exec($sql);
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        return $res;
    }

    public function deleteEmployee($id)
    {
        try {
            $sql = "delete from emps where id=$id";
            $res = self::getEmpDB()->exec($sql);
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        return $res;
    }
}
