
<?php

include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  
require_once("/xampp/htdocs/adminApp/Models/Coach.php");
include("/xampp/htdocs/adminApp/config.php");

require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  
require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  

$CategoryDAO = new CategoryDAO($conn);
$contactDAO = new ContactDAO($conn);

class CoachDAO {
    
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Méthode pour insérer un nouveau coach dans la base de données
    public function create(Coach $coach) {
        try {
            
            $contact = $coach->getContact();
            $stmt = $this->conn->prepare("INSERT INTO contacts (firstname,lastname,email,phoneNumber) VALUES (?, ?, ?,?)");
            $stmt->execute([$contact->getFirstName(),$contact->getLastName(), $contact->getEmail(), $contact->getPhoneNumber()]);
$idCreatedContact = $this->conn->lastInsertId();
            $category = $coach->getCategory();
            $stmt = $this->conn->prepare("INSERT INTO coaches ( firstName, lastName, email, password, isAdmin,contact,category) VALUES (?, ?, ?, ?, ?, ?,?)");
            $stmt->execute([ $coach->getFirstName(), $coach->getLastName(), $coach->getEmail(), $coach->getPassword(), $coach->isAdmin(),$idCreatedContact,$category->getIdCategory()]);

            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }


    // Méthode pour récupérer tous les coachs de la base de données
// Méthode pour récupérer tous les membres de la base de données
    public function getAll($CategoryDAO,$contactDAO) {
        try {
            $stmt = $this->conn->query("SELECT * FROM coaches");
            $coaches = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 
        $category= $CategoryDAO->getByid($row['category']);
        $contact= $contactDAO->getByID($row['contact']);

                $coaches[] = new Coach($row['licenseNumber'],$row['firstName'], $row['lastName'],$contact, $category,$row['email'],$row['password'],$row['isAdmin']);
            }
    
            return $coaches;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de rÃ©cupÃ©ration ici
            return [];
        }
    }
// Méthode pour récupérer un coach par son id
public function getByiD($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM coaches WHERE licenseNumber = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Coach');
        return $stmt->fetch();
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

// Méthode pour récupérer un coach par son licenseNumber

public function getByLicenseNumber($licenseNumber,$contactDAO,$CategoryDAO) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM coaches WHERE licenseNumber = ?");
        $stmt->execute([$licenseNumber]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Coach');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $category= $CategoryDAO->getByid($row['category']);
        $contact= $contactDAO->getByID($row['contact']);
        if ($row) {
            return new Coach($row['licenseNumber'],$row['firstName'], $row['lastName'],$contact, $category,$row['email'],$row['password'],$row['isAdmin']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

public function getByemail($email,$ContactDAO,$CategoryDAO) {
    try {
 
        $stmt = $this->conn->prepare("SELECT * FROM coaches WHERE email = ?");
        $stmt->execute([$email]);
       
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Coach');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $category= $CategoryDAO->getById($row['category']);

        $contact= $ContactDAO->getByemail($email);
        if ($row) {
            return new Coach($row['licenseNumber'],$row['firstName'], $row['lastName'],$contact,$category,$row['email'],$row['password'],$row['isAdmin']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}
// Méthode pour mettre à jour un coach
public function update(Coach $coach) {
    try {
        $stmt = $this->conn->prepare("UPDATE coaches SET  firstName = ?, lastName = ?, email = ?, password = ?, isAdmin = ? WHERE licenseNumber = ?");
        $stmt->execute([ $coach->getFirstName(), $coach->getLastName(), $coach->getEmail(), $coach->getPassword(), $coach->isAdmin(), $coach->getLicenseNumber()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }

}
// Méthode pour supprimer un coach
public function delete(Coach $coach) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM coaches WHERE licenseNumber = ?");
        $stmt->execute([$coach->getLicenseNumber()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }

}
}

?>

