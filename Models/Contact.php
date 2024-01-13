<?php

class Contact {
    private $idContact;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;

    public function __construct($idContact,$firstName, $lastName, $email, $phoneNumber) {
        $this->idContact = $idContact;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function getIdContact() {
        return $this->idContact;
    }
    public function setIdContact($id) {
        $this->idContact=$id;
    }

    public function getFirstName() {
        return $this->firstName;
    }
 
    public function setFirstName($firstName) {
        $this->firstName=$firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($lastName) {
        $this->lastName=$lastName;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email=$email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber=$phoneNumber;
    }
}
