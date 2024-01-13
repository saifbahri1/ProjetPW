<?php
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  

include("/xampp/htdocs/adminApp/config.php");
$CategoryDAO=new CategoryDAO($conn);



  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category = new Category(null, $_POST['name'], $_POST['shortCode']);
        if ($CategoryDAO->create($category)) {
            header("Location: /adminApp/Views/category_list.php");
            exit();
        } else {
            echo "Erreur lors de la création du Category.";
        }
}

// Inclure la vue pour afficher la confirmation de l'ajout du Category
include('../adminApp/Views/category_create.php');
    
