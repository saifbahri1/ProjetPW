<?php
include("/xampp/htdocs/adminApp/DAO/MemberDAO.php"); 
require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php"); 
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php"); 
include("/xampp/htdocs/adminApp/config.php");


$MemberDAO = new MemberDAO($conn);
$ContactDAO = new ContactDAO($conn);
$CategoryDAO = new CategoryDAO($conn);


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

    $contactNew= $ContactDAO->getByEmail($contactEmail);

   


    // Données du membre
    $memberFirstName = $_POST['firstName'];
    $memberLastName = $_POST['lastName'];

$category = $CategoryDAO->getByname($_POST['category']);


    // Créer un objet Member avec le contact
    $member = new Member(null, $memberFirstName, $memberLastName, $contactNew, $category);

    // Insérer le membre dans la base de donnée
    $MemberDAO->create($member);
        //Rediriger vers la liste des membres
        header("Location: /adminApp/Views/MemberViews/member_list.php");
        
}

// Inclure la vue pour afficher le formulaire d'ajout d'un membre
include('/xampp/htdocs/adminApp/Views/MemberViews/member_create.php');




?>
