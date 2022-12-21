<?php
class Employee
{
    private $id, $firstname, $lastname, $email, $dob;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setDob($dob)
    {
        $this->dob = $dob;
    }
    public function getDob()
    {
        return $this->dob;
    }
}
