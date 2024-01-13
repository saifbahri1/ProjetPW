<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  

        // Créer une instance de ContactDAO
$ContactDAO=new ContactDAO($conn);

        // Récupérer le numéro de licence à partir du paramètre d'URL
        $idContact = $_GET['idContact'];

        // Récupérer le member à modifier en utilisant son licenseNumber
        $contact = $ContactDAO->getById($idContact);

        if (!$contact) {
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $idContact = $_POST['idContact'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
          
            // Mettre à jour les détails du member
        $contact->setFirstName($firstName);
        $contact->setLastName($lastName);
        $contact->setEmail($email);
        $contact->setPhoneNumber($phoneNumber);
          
            if ($ContactDAO->update($contact)) {
                header("Location:/adminApp/Views/ContactViews/contact_list.php");
                exit();
            } else {
                echo "Erreur lors de la modification du contact.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du contact
        include('/xampp/htdocs/adminApp/Views/ContactViews/contact_update.php');




?>