<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "category")]
class Category {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"category_id",type: "integer")]
    private int $idCategory;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string")]
    private string $shortCode;

    public function __construct(int $idCategory, string $name, string $shortCode) {
        $this->idCategory = $idCategory;
        $this->name = $name;
        $this->shortCode = $shortCode;
    }


    public function getIdCategory(): int {
        return $this->idCategory;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getShortCode(): string {
        return $this->shortCode;
    }
    public function setIdCategory(int $id): void {
        $this->idCategory=$id;
    }

    public function setName(string $name): void {
     $this->name=$name;
    }

    public function setShortCode(string $shortCode): void {
        $this->shortCode=$shortCode;
    }
}
