<?php

class Category {
    private $idCategory;
    private $name;
    private $shortCode;

    public function __construct($idCategory,$name, $shortCode) {
        $this->idCategory = $idCategory;
        $this->name = $name;
        $this->shortCode = $shortCode;
    }


    public function getIdCategory() {
        return $this->idCategory;
    }

    public function getName() {
        return $this->name;
    }

    public function getShortCode() {
        return $this->shortCode;
    }
}