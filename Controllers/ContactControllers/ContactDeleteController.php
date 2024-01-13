<?php

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");

$ContactDAO=new ContactDAO($conn);



$idContact = $_GET['idContact'];
        $contact = $ContactDAO->getById($idContact);

        if (!$contact) {
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ContactDAO->deleteById($idContact);
                header("Location: /adminApp/Views/ContactViews/contact_list.php");
          
        }

        include('/xampp/htdocs/adminApp/Views/ContactViews/contact_delete.php');


?>