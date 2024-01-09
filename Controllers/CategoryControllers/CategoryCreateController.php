<?php
include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  

include("/xampp/htdocs/adminApp/config.php");
$CategoryDAO=new CategoryDAO($conn);



  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category(null, $_POST['name'], $_POST['shortCode']);
    $CategoryDAO->create($category);
            
            header("Location: ../Views/category_list.php");
        } 
    
