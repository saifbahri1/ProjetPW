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
            echo "Le Category n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['name'];
            $shortcode = $_POST['shortCode'];
          

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Mettre à jour les détails du Category
      $Category->setName($nom);
            $Category->setShortCode($shortcode);
          
            // Appeler la méthode du modèle (ContactDAO) pour mettre à jour le Category
            if ($CategoryDAO->update($Category)) {
                // Rediriger vers la page de détails du Category après la modification
                header("Location: /adminApp/Views/category_list.php");
                exit();
            } else {
                // Gérer les erreurs de mise à jour du Category
                echo "Erreur lors de la modification du Category.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du Category
        include('../adminApp/Views/category_update.php');




?>