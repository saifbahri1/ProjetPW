<?php

include("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  

  
class CoachDAO {
    
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    // Méthode pour insérer un nouveau coach dans la base de données
    public function create(Coach $coach) {
        try {
            $category = $coach->getCategory();
            $stmt = $this->conn->prepare("INSERT INTO coaches (licenseNumber, firstName, lastName, email, password, isAdmin,category) VALUES (?, ?, ?, ?, ?, ?,?)");
            $stmt->execute([$coach->getLicenseNumber(), $coach->getFirstName(), $coach->getLastName(), $coach->getEmail(), $coach->getPassword(), $coach->isAdmin(),$category->getIdCategory()]);
            $contact = $coach->getContact();
            $stmt = $this->conn->prepare("INSERT INTO contacts (firstname,lastname,email,phoneNumber) VALUES (?, ?, ?,?)");
            $stmt->execute([$contact->getFirstName(),$contact->getLastName(), $contact->getEmail(), $contact->getPhoneNumber()]);

           

            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }


    // Méthode pour récupérer tous les coachs de la base de données
public function getAll() {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM coaches");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Coach');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}
// Méthode pour récupérer un coach par son id
public function getById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM coaches WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Coach');
        return $stmt->fetch();
    } catch (PDOException $e) {
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
        
        
        $category= $CategoryDAO->getByid($row['category']);

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
        $stmt = $this->conn->prepare("UPDATE coaches SET licenseNumber = ?, firstName = ?, lastName = ?, email = ?, password = ?, isAdmin = ? WHERE id = ?");
        $stmt->execute([$coach->getLicenseNumber(), $coach->getFirstName(), $coach->getLastName(), $coach->getEmail(), $coach->getPassword(), $coach->isAdmin(), $coach->getLicenseNumber()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }

}
// Méthode pour supprimer un coach
public function delete(Coach $coach) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM coaches WHERE id = ?");
        $stmt->execute([$coach->getLicenseNumber()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }

}
}

?>