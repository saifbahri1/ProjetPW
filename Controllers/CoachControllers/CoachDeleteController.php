<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/CoachDAO.php");  

$CoachDAO=new CoachDAO($conn);



$licenseNumber = $_GET['licenseNumber'];
        // Récupérer le coach à supprimer en utilisant son email
        $coach = $CoachDAO->getByLicenseNumber($licenseNumber,$contactDAO,$CategoryDAO);

        if (!$coach) {
            // L'éducateur n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "L'éducateur n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le coach en appelant la méthode du modèle (CoachDAO)
            if ($CoachDAO->delete($coach)) {
                // Rediriger vers la page d'accueil après la suppression
                header("Location: /adminApp/Views/CoachViews/coach_list.php");
                exit();
            } else {
                // Gérer les erreurs de suppression du membre
                echo "Erreur lors de la suppression de cet éducateur.";
            }
        }

        // Inclure la vue pour afficher la confirmation de suppression du coach
        include('../adminApp/Views/CoachViews/coach_delete.php');

?>