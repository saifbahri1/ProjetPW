<?php

class ContactDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Méthode pour insérer un nouveau contact dans la base de données
    public function create(Contact $contact) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO contacts (firstName, lastName, email, phoneNumber) VALUES (?, ?, ?, ?)");
            $stmt->execute([$contact->getFirstName(), $contact->getLastName(), $contact->getEmail(), $contact->getPhoneNumber()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }

    // Méthode pour récupérer tous les contacts de la base de données
public function getAll() {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM contacts");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Contact');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}
// Méthode pour récupérer un contact par son id
public function getByEmail($email) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE email = ?");
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Contact');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($row) {
            return new Contact($row['id'],$row['firstname'], $row['lastname'],$row['email'],$row['phonenumber']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}
// Méthode pour mettre à jour un contact
public function update(Contact $contact) {
    try {
        $stmt = $this->conn->prepare("UPDATE contacts SET firstName = ?, lastName = ?, email = ?, phoneNumber = ? WHERE id = ?");
        $stmt->execute([$contact->getFirstName(), $contact->getLastName(), $contact->getEmail(), $contact->getPhoneNumber(), $contact->getIdContact()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }

}
// Méthode pour supprimer un contact
public function delete(Contact $contact) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$contact->getIdContact()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}
}

?>