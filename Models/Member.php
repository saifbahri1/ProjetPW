<?php

class Member {
    private $licenseNumber;
    private $firstName;
    private $lastName;
    private $contact;
    private $category;

    public function __construct($licenseNumber, $firstName, $lastName, Contact $contact, Category $category) {
        $this->licenseNumber = $licenseNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->contact = $contact;
        $this->category = $category;
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

    public function getCategory() {
        return $this->category;
    }
}
