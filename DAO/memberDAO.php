use Member;
<?php

class MemberDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create(Member $member) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO members (license_number, first_name, last_name, contact_id, category_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$member->getLicenseNumber(), $member->getFirstName(), $member->getLastName(), $member->getContact()->getId(), $member->getCategory()->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici (par exemple, numéro de licence déjà existant)
            return false;
        }
    }
    
    // Méthode pour récupérer tous les membres de la base de données
public function getAll() {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM members");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}
// Méthode pour récupérer un membre par son id
public function getById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
        return $stmt->fetch();
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
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
}

?>