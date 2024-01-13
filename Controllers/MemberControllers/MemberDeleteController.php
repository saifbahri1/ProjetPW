<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");  
include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");

$MemberDAO=new MemberDAO($conn);
$CategoryDAO=new CategoryDAO($conn);
$ContactDAO=new ContactDAO($conn);



$licenseNumber = $_GET['licenseNumber'];
        // Récupérer le membre à supprimer en utilisant son licenseNumber
        $member = $MemberDAO->getByLicenseNumber($licenseNumber, $CategoryDAO,$ContactDAO);

        if (!$member) {
            // Le membre n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le licencié n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le membre en appelant la méthode du modèle (MembreDAO)
            $MemberDAO->deleteByLicenseNumber($licenseNumber);
                header("Location: /adminApp/Views/MemberViews/member_list.php");
          
        }

        // Inclure la vue pour afficher la confirmation de suppression du membre
        include('/xampp/htdocs/adminApp/Views/MemberViews/member_delete.php');



?>