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

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
}
