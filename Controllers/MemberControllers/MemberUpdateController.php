<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");  

$MemberDAO=new MemberDAO($conn);

        // Récupérer le numéro de licence à partir du paramètre d'URL
        $licenseNumber = $_GET['licenseNumber'];

        // Récupérer le member à modifier en utilisant son licenseNumber
        $member = $MemberDAO->getByLicenseNumber($licenseNumber, $CategoryDAO,$contactDAO);

        if (!$member) {
            // Le member n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le licencié n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email=$_POST['email'];
            $phoneNumber=$_POST['phoneNumber'];
            $category = $_POST['category'];
            $category = $CategoryDAO->getByname($category);
            
          
       $newMember=new Member($licenseNumber,$firstName,$lastName,new Contact($member->getContact()->getIdContact(),$firstName,$lastName,$email,$phoneNumber),$category);
          
            // Appeler la méthode du modèle (MemberDAO) pour mettre à jour le Category
            if ($MemberDAO->update($newMember)) {
                header("Location: /adminApp/Views/MemberViews/member_list.php");
                exit();
            } else {
                echo "Erreur lors de la modification du licencié.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du licencié
        include('/xampp/htdocs/adminApp/Views/MemberViews/member_update.php');




?>