<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  

$CategoryDAO=new CategoryDAO($conn);

        // Récupérer l'id à partir du paramètre d'URL
        $categoryId = $_GET['id'];

        // Récupérer le Category à modifier en utilisant son ID
        $Category = $CategoryDAO->getById($categoryId);

        if (!$Category) {
            // Le Category n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "La Categorie n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['name'];
            $shortcode = $_POST['shortCode'];
          
            // Mettre à jour les détails du Category
            $Category->setName($nom);
            $Category->setShortCode($shortcode);
          
            $CategoryDAO->update($Category);
                header("Location: /adminApp/Views/category_list.php");
                exit();
          
        }

        // Inclure la vue pour afficher le formulaire de modification du Category
        include('/xampp/htdocs/adminApp/Views/category_update.php');




?>