<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");  

$MemberDAO=new MemberDAO($conn);

        // Récupérer le numéro de licence à partir du paramètre d'URL
        $licenseNumber = $_GET['licenseNumber'];

        // Récupérer le member à modifier en utilisant son licenseNumber
        $member = $MemberDAO->getByLicenseNumber($licenseNumber, $CategoryDAO,$ContactDAO);

        if (!$member) {
            // Le member n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le licencié n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['licenseNumber'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $contact = $_POST['contact'];
            $category = $_POST['category'];
          
            // Mettre à jour les détails du member
        $member->setFirstName($firstName);
        $member->setLastName($lastName);
        $member->setContact($contact);
        $member->setCategory($category);
          
            // Appeler la méthode du modèle (MemberDAO) pour mettre à jour le Category
            if ($MemberDAO->update($member)) {
                header("Location: /adminApp/Views/MemberViews/member_list.php");
                exit();
            } else {
                echo "Erreur lors de la modification du licencié.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du licencié
        include('../adminApp/Views/MemberViews/member_update.php');




?>