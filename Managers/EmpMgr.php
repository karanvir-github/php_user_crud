<?php
require_once "../DB/dbconfig.php";


class EmpMgr
{
    public $result = 0;
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
            if (self::getEmpDB()->exec($sql)) {
                $result = 1;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    public function getDataByPage($pageToServe, $lastPageServed)
    {
        $conditionalData["rows"] = self::getTotalRowsInDb();
        $differncy = $pageToServe - $lastPageServed;
        if ($differncy > 0) {
            $offSet = 5 * $differncy;
            $sql = "Select * from emps order by id desc limit 5 offset $offSet";
        } else {
            $sql = "Select * from emps order by id desc limit 5";
        }
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $conditionalData["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conditionalData["lastPageServed"] = $lastPageServed;
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
            if (self::getEmpDB()->exec($sql)) {
                $result = 1;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    public function deleteEmployee($id)
    {
        try {
            $sql = "delete from emps where id=$id";
            if (self::getEmpDB()->exec($sql)) {
                $result = 1;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }


    public function deleteSelectedEmployees($ids)
    {
        try {
            $sql = "delete from emps where id in ($ids)";
            if (self::getEmpDB()->exec($sql)) {
                $result = 1;
            }
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    public function getTotalRowsInDb()
    {
        $sql = "select count(*) from emps";
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $res = $stmt->fetchColumn();
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }
        return $res;
    }

    public function searchEmployeeWithFilter($searchSlug, $condition)
    {
        $sql = "select * from emps where $condition LIKE '%$searchSlug%' order by id desc";
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }
        return $res;
    }

    public function searchEmployee($searchSlug)
    {
        $sql = "select * from emps where firstname LIKE '%$searchSlug%' OR lastname LIKE '%$searchSlug%' OR email LIKE '%$searchSlug%' order by id desc";
        try {
            $stmt = self::getEmpDB()->query($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $res = $e->getMessage();
        }
        return $res;
    }
}
