<?php

class Member {
    private $idMember;
    private $licenseNumber;
    private $firstName;
    private $lastName;
    private $contact;

    public function __construct($idMember,$licenseNumber, $firstName, $lastName, $contact) {
        $this->idMember = $idMember;
        $this->licenseNumber = $licenseNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->contact = $contact;
    }

    

    public function getIdMember() {
        return $this->idMember;
    }
    public function getLicenseNumber() {
        return $this->licenseNumber;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getContact() {
        return $this->contact;
    }
}
