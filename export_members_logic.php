<?php

// Function to export members to CSV
function exportMembersToCSV() {
    include("/xampp/htdocs/adminApp/config.php");
    include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");  
    require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  
    require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  
    $categoryDAO = new CategoryDAO($conn);
    $contactDAO = new ContactDAO($conn);

    $MemberDAO = new MemberDAO($conn);
    $members = $MemberDAO->getAll($categoryDAO, $contactDAO);

    $csvFileName = "Members.csv";

    header("Content-Type: text/csv");
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

    $output = fopen('php://output', 'w');

    // CSV Header
    fputcsv($output, ["Numéro de licence", "Nom", "Prénom", "Email", "Catégorie"]);

    // CSV Data
    foreach ($members as $member) {
        fputcsv($output, [
            $member->getLicenseNumber(),
            $member->getFirstName(),
            $member->getLastName(),
            $member->getContact()->getEmail(),
            $member->getCategory()->getName()
        ]);
    }

    fclose($output);
}

// Call the export function
exportMembersToCSV();
