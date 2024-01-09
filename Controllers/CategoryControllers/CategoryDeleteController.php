<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  

$CategoryDAO=new CategoryDAO($conn);



$CategoryId = $_GET['id'];
        // Récupérer le Category à supprimer en utilisant son ID
        $Category = $CategoryDAO->getById($CategoryId);

        if (!$Category) {
            // Le Category n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le Category n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le Category en appelant la méthode du modèle (ContactDAO)
            if ($CategoryDAO->deleteById($CategoryId)) {
                // Rediriger vers la page d'accueil après la suppression
                header("Location: /adminApp/Views/category_list.php");
                exit();
            } else {
                // Gérer les erreurs de suppression du Category
                echo "Erreur lors de la suppression du Category.";
            }
        }

        // Inclure la vue pour afficher la confirmation de suppression du Category
        include('../adminApp/Views/category_delete.php');



?>