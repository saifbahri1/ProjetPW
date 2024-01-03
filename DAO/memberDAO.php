use Member;
<?php

class MemberDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Méthode pour insérer un nouveau membre dans la base de données
    public function create(Member $member) {
        try {
            // Assurez-vous que la table `members` existe et contient les colonnes nécessaires
            $stmt = $this->conn->prepare("INSERT INTO members (licenseNumber, firstName, lastName) VALUES (?, ?, ?)");
            $stmt->execute([$member->getLicenseNumber(), $member->getFirstName(), $member->getLastName()]);

            // Récupérez l'ID du membre nouvellement inséré
            $memberId = $this->conn->lastInsertId();

            // Insérez les détails de contact dans la table `contacts`
            $contact = $member->getContact();
            $stmt = $this->conn->prepare("INSERT INTO contacts (memberId, email, phoneNumber) VALUES (?, ?, ?)");
            $stmt->execute([$memberId, $contact->getEmail(), $contact->getPhoneNumber()]);

            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
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
        $stmt->execute([$member->getLicenseNumber(), $member->getFirstName(), $member->getLastName(), $member->getIdMember()]);

        // Mettre à jour les détails de contact dans la table `contacts`
        $contact = $member->getContact();
        $stmt = $this->conn->prepare("UPDATE contacts SET email = ?, phoneNumber = ? WHERE memberId = ?");
        $stmt->execute([$contact->getEmail(), $contact->getPhoneNumber(), $member->getIdMember()]);

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
        $stmt->execute([$member->getIdMember()]);

        // Supprimer le membre de la table `members`
        $stmt = $this->conn->prepare("DELETE FROM members WHERE id = ?");
        $stmt->execute([$member->getIdMember()]);

        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}
}

?>