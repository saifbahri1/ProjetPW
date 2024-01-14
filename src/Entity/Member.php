<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


  #[ORM\Entity]
  #[ORM\Table(name: "member")]
  #[ORM\InheritanceType("JOINED")] // Specify the inheritance mapping type
  #[ORM\DiscriminatorColumn(name: "type", type: "string")]

class Member {


#[ORM\Id]
#[ORM\GeneratedValue]  
#[ORM\Column(name:"license_number",type: "integer")]
    private $licenseNumber;

    #[ORM\Column(type: "string")]
public $firstName;

    #[ORM\Column(type: "string")]
    public $lastName;

    #[ORM\ManyToOne(targetEntity: "Contact")]
    #[ORM\JoinColumn(referencedColumnName: "contact_id")]
    private $contact;
    
    #[ORM\ManyToOne(targetEntity: "Category")]
    #[ORM\JoinColumn(referencedColumnName: "category_id")]
    private $category;


    public function __construct($licenseNumber, $firstName, $lastName, Contact $contact, Category $category) {
        $this->licenseNumber = $licenseNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->contact = $contact;
        $this->category = $category;
    }

 
    public function getfirstName(): string
    {
        return $this->firstName;
    }
    public function getLicenseNumber() {
        return $this->licenseNumber;
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