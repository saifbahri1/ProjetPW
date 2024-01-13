<?php
include("/xampp/htdocs/adminApp/config.php");

include("/xampp/htdocs/adminApp/DAO/ContactDAO.php"); 


$ContactDAO = new ContactDAO($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Données du contact
    $contactFirstName = $_POST['firstName'];
    $contactLastName = $_POST['lastName'];
    $contactEmail = $_POST['email'];
    $contactPhoneNumber = $_POST['phoneNumber'];

    // Créer un objet Contact
    $contact = new Contact(null, $contactFirstName, $contactLastName, $contactEmail, $contactPhoneNumber);

    // Insérer le contact dans la base de données
    $ContactDAO->create($contact);

        //Rediriger vers la liste des membres
        header("Location: /adminApp/Views/ContactViews/contact_list.php");
        
}

include('/xampp/htdocs/adminApp/Views/ContactViews/contact_create.php');



?>
