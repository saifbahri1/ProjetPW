<?php
require_once("/xampp/htdocs/adminApp/Models/Member.php");

Class Coach extends Member
{
    private $email;
    private $password;
    private $isAdmin;

    public function __construct($licenseNumber,$firstName, $lastName, Contact $contact, Category $category, $email, $password, $isAdmin = false)
    {
        parent::__construct($licenseNumber, $firstName, $lastName, $contact, $category);
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    // Getters and Setters

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}