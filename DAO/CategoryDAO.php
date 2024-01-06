<?php



class CategoryDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
 // Méthode pour insérer une nouvelle catégorie dans la base de données
public function create(Category $category) {
    try {
        $stmt = $this->conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$category->getName()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs d'insertion ici
        return false;
    }
}
// Méthode pour récupérer toutes les catégories de la base de données
public function getAll() {
    try {
        $stmt = $this->conn->query("SELECT * FROM categories");
        $contacts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = new Category($row['id'],$row['name'], $row['shortCode']);
        }

        return $contacts;
    } catch (PDOException $e) {
        // GÃ©rer les erreurs de rÃ©cupÃ©ration ici
        return [];
    }
}

// Méthode pour récupérer une catégorie par son id
public function getById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Category($row['id'],$row['name'], $row['shortCode']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}

public function getByname($name) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE name = ?");
        $stmt->execute([$name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Category($row['id'],$row['name'], $row['shortCode']);

    }else{return false;
    } }catch (PDOException $e) {
        // Gérer les erreurs de récupération ici
        return false;
    }
}



// Méthode pour mettre à jour une catégorie
public function update(Category $category) {
    try {
        $stmt = $this->conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$category->getName(), $category->getIdCategory()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }
}
// Méthode pour supprimer une catégorie
public function delete(Category $category) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$category->getIdCategory()]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de suppression ici
        return false;
    }
}
}


?>