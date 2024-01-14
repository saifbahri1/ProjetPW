<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contact")]
class Contact {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"contact_id",type: "integer")]
  
    private $idContact;

    #[ORM\Column(type: "string")]
    private $firstName;

    #[ORM\Column(type: "string")]
    private $lastName;

    #[ORM\Column(type: "string")]
    private $email;

    #[ORM\Column(type: "string")]
    private $phoneNumber;

    public function __construct($idContact, $firstName, $lastName, $email, $phoneNumber) {
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