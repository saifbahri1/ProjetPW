<?php
require_once("/xampp/htdocs/adminApp/Models/Member.php");
class MemberDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create(Member $member) {
        try {
            // Insérer les détails du membre dans la table `members`
            $stmt = $this->conn->prepare("INSERT INTO members (firstName, lastName,contact,category) VALUES (?, ?,?,?)");
            $stmt->execute([$member->getFirstName(), $member->getLastName(),$member->getContact()->getIdContact(),$member->getCategory()->getIdCategory()]);

            // Récupérer l'ID du membre nouvellement inséré
            $memberId = $this->conn->lastInsertId();

            // Insérer les détails de contact dans la table `contacts`
            $contact = $member->getContact();
            $stmt = $this->conn->prepare("INSERT INTO contacts (id, email, phoneNumber) VALUES (NULL, ?, ?)");
            $stmt->execute([$memberId, $contact->getEmail(), $contact->getPhoneNumber()]);

            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }
    
    // Méthode pour récupérer tous les membres de la base de données
    public function getAll($CategoryDAO,$contactDAO) {
        try {
            $stmt = $this->conn->query("SELECT * FROM members");
            $members = [];
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 
        $category= $CategoryDAO->getByid($row['category']);
        $contact= $contactDAO->getByID($row['contact']);

                $members[] = new Member($row['licenseNumber'],$row['firstName'], $row['lastName'],$contact, $category);
            }
    
            return $members;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de rÃ©cupÃ©ration ici
            return [];
        }
    }


// Méthode pour mettre à jour un membre
public function update(Member $member) {
    try {
        // Assurez-vous que la table `members` existe et contient les colonnes nécessaires
        $stmt = $this->conn->prepare("UPDATE members SET licenseNumber = ?, firstName = ?, lastName = ? WHERE id = ?");
        $stmt->execute([$member->getLicenseNumber(), $member->getFirstName(), $member->getLastName(), $member->getLicenseNumber()]);

        // Mettre à jour les détails de contact dans la table `contacts`
        $contact = $member->getContact();
        $stmt = $this->conn->prepare("UPDATE contacts SET email = ?, phoneNumber = ? WHERE memberId = ?");
        $stmt->execute([$contact->getEmail(), $contact->getPhoneNumber(), $member->getLicenseNumber()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }

}


// Méthode pour récupérer un membre par son licenseNumber

public function getByLicenseNumber($licenseNumber,$CategoryDAO,$contactDAO) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE licenseNumber = ?");
        $stmt->execute([$licenseNumber]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $category= $CategoryDAO->getByid($row['category']);
        $contact= $contactDAO->getByID($row['contact']);
        if ($row) {
            return new Member($row['licenseNumber'],$row['firstName'], $row['lastName'],$contact, $category);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

// Méthode pour supprimer un membre
public function delete(Member $member) {
    try {
        // Supprimer les détails de contact dans la table `contacts`
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE memberId = ?");
        $stmt->execute([$member->getLicenseNumber()]);

        // Supprimer le membre de la table `members`
        $stmt = $this->conn->prepare("DELETE FROM members WHERE id = ?");
        $stmt->execute([$member->getLicenseNumber()]);

        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}

// Méthode pour obtenir l'ID du contact associé à un membre
private function getContactIdByLicenseNumber($licenseNumber) {
    $stmt = $this->conn->prepare("SELECT idContact FROM members WHERE licenseNumber = ?");
    $stmt->execute([$licenseNumber]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['idContact'] ?? null;
}
// Méthode pour supprimer un membre par son numéro de licence
public function deleteByLicenseNumber($licenseNumber) {
    try {
        // Supprimer le membre de la table des membres
        $stmt = $this->conn->prepare("DELETE FROM members WHERE licenseNumber = ?");
        $stmt->execute([$licenseNumber]);

        // Obtenez l'ID du contact associé à ce membre
        $contactId = $this->getContactIdByLicenseNumber($licenseNumber);

        // Supprimer le contact de la table des contacts
        if ($contactId) {
          //  $this->ContactDAO->deleteById($contactId);
        }

        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}


}


?>