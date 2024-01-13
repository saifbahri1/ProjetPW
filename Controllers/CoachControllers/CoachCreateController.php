<?php
include("/xampp/htdocs/adminApp/DAO/CoachDAO.php");
require_once("/xampp/htdocs/adminApp/DAO/MemberDAO.php");
require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
include("/xampp/htdocs/adminApp/config.php");

$CoachDAO = new CoachDAO($conn);
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

    $contactNew = $ContactDAO->getByEmail($contactEmail);

    // Données spécifiques au coach
    $coachFirstName = $_POST['firstName'];
    $coachLastName = $_POST['lastName'];
    $coachEmail = $_POST['email'];
    $coachPassword = $_POST['coachPassword'];
    $isAdmin = $_POST['isAdmin'];

    $categoryName = $_POST['category'];
    $category = $CategoryDAO->getByName($categoryName);
    
    // Créer un objet Member avec le contact et la catégorie
  

    // Récupérer le LicenceNumber du membre nouvellement créé



    // Créer un objet Coach avec le contact, le membre et les données du coach
    $coach = new Coach(NULL,$coachFirstName, $coachLastName,$contactNew,$category, $coachEmail,$coachPassword, $isAdmin);

    // Insérer le coach dans la base de données
    $CoachDAO->create($coach);

    // Rediriger vers la liste des coaches
    header("Location: /adminApp/Views/CoachViews/coach_list.php");
    exit();
}

// Inclure la vue pour afficher le formulaire d'ajout d'un coach
include('/xampp/htdocs/adminApp/Views/CoachViews/coach_create.php');
?>
