<?php
require_once "../DB/dbconfig.php";


class UserMgr
{
    public function getUserDB()
    {
        $userDB = new DB();
        $userDB = $userDB->connection();
        return $userDB;
    }

    public function insertUser($user)
    {
        try {
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $dob = $user->getDob();
            $sql = "insert into users (firstname,lastname,email, dob) values ('$firstname','$lastname','$email','$dob')";
            $res = self::getUserDB()->exec($sql);
            $res = 1;
        } catch (Exception $e) {
            $res = $e->getMessage();
        }
        return $res;
    }

    public function getDataByPage($page)
    {
        $getDataFrom = $page > 1 ? ($page * 5) : 1;
        $sql = "Select * from users where id >'.$getDataFrom.'order by id DESC limit 5";
        try {
            $stmt = self::getUserDB()->query($sql);
            $stmt->execute();
            $conditionalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
        return $conditionalData;
    }
}
