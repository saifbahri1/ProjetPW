<?php
require_once("/xampp/htdocs/adminApp/Models/Contact.php");

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
        $stmt->execute(); // Execute the prepared statement

        $contacts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = new Contact($row['id'], $row['firstName'], $row['lastName'], $row['email'], $row['phoneNumber']);
        }

        return $contacts;
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return [];
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
            return new Contact($row['id'],$row['firstName'], $row['lastName'],$row['email'],$row['phoneNumber']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

public function getById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Contact');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($row) {
            return new Contact($row['id'],$row['firstName'], $row['lastName'],$row['email'],$row['phoneNumber']);

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


// Méthode pour supprimer un contact par son id
public function deleteById($idContact) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$idContact]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}

// Méthode pour récupérer le dernier id inséré
public function getLastId() {
    try {
        $stmt = $this->conn->prepare("SELECT MAX(id) as max_id FROM contacts");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si max_id est défini et non nul
        if (isset($row['max_id'])) {
            return $row['max_id'];
        } else {
            // Aucun enregistrement trouvé, peut-être que la table est vide
            return null;
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

}

?>