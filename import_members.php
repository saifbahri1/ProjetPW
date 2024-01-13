<?php
include("/xampp/htdocs/adminApp/config.php");

include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");
include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");

if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    // Récupérer le contenu du fichier
    $csvFile = file_get_contents($_FILES['file']['tmp_name']);

    // Convertir le contenu du fichier en tableau associatif
    $csvData = array_map('str_getcsv', preg_split('/\r\n|\n|\r/', $csvFile));

    if (count($csvData) > 1) {
        $MemberDAO = new MemberDAO($conn);
        $CategoryDAO = new CategoryDAO($conn);
        $ContactDAO = new ContactDAO($conn);
        

        // Parcourez le tableau de données (en excluant la première ligne qui est l'en-tête)
        for ($i = 1; $i < count($csvData); $i++) {
            $rowData = $csvData[$i];

            // Récupérer les données individuelles
            $licenseNumber = $rowData[0];
            $firstName = $rowData[1];
            $lastName = $rowData[2];
            $email = $rowData[3];
            $phoneNumber = $rowData[4];
            $idContact = $rowData[4];
            $categoryName = $rowData[4];

            // Obtenez l'ID de la catégorie par son nom
            $category = $CategoryDAO->getByname($categoryName);


            // Créez une instance de Member avec les données
            $member = new Member($licenseNumber, $firstName, $lastName, new Contact($idContact,$firstName,$lastName,$email,$phoneNumber), new Category($categoryId,$name,$shortCode));

            // Ajoutez le membre à la base de données
            $MemberDAO->create($member);
        }

        echo json_encode(['success' => true, 'message' => 'Importation réussie']);
        exit();
    }
}

echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'importation']);
exit();
?>

