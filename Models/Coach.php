<?php
   include("/xampp/htdocs/adminApp/Models/Member.php");  // Adjust the path accordingly

class Coach extends Member {

    private $email;
    private $password;
    private $isAdmin;

    public function __construct($licenseNumber, $firstName, $lastName, $contact,$category, $email, $password, $isAdmin = false) {
        parent::__construct($licenseNumber, $firstName, $lastName, $contact,$category);

        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    // Getters and Setters

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAdmin() {
        return $this->isAdmin;
    }
}
