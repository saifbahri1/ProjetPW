<?php

class Coach extends Member {
    private $idCoach;
    private $email;
    private $password;
    private $isAdmin;

    public function __construct($idCoach,$licenseNumber, $firstName, $lastName, $contact, $email, $password, $isAdmin = false) {
        parent::__construct($licenseNumber, $firstName, $lastName, $contact, $email);
        $this->idCoach = $idCoach;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    // Getters and Setters
    public function getIdCoach() {
        return $this->idCoach;
    }
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
