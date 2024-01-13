<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/CoachDAO.php");  

$CoachDAO=new CoachDAO($conn);

        // Récupérer le numéro de licence à partir du paramètre d'URL
        $licenseNumber = $_GET['licenseNumber'];

        // Récupérer l'éducateur à modifier en utilisant son licenseNumber
        $coach = $CoachDAO->getByLicenseNumber($licenseNumber,$contactDAO,$CategoryDAO);

        if (!$coach) {
            // L'éducateur n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "L'éducateur n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $isAdmin = $_POST['isAdmin'];
            $contact = $_POST['contact'];
            $category = $_POST['category'];


        $coach->setFirstName($firstName);
        $coach->setLastName($lastName);
        $coach->setEmail($email);
        $coach->setPassword($password);
        $coach->setIsAdmin($isAdmin);
        $coach->setContact($contact);
        $coach->setCategory($category);
          
            if ($CoachDAO->update($coach)) {
                header("Location:/adminApp/Views/CoachViews/coach_list.php");
                exit();
            } else {
                echo "Erreur lors de la modification de l'éducateur.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification de l'éducateur.
        include('/xampp/htdocs/adminApp/Views/CoachViews/coach_update.php');



?>