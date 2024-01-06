<?php



class CategoryDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
// Méthode pour insérer une nouvelle catégorie dans la base de données
public function create(Category $category) {
    try {
        $stmt = $this->conn->prepare("INSERT INTO categories (name, shortCode) VALUES (?, ?)");
        $stmt->execute([$category->getName(), $category->getShortCode()]);
        return true;
    } catch (PDOException $e) {
        
        error_log($e->getMessage());
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
        return false;
    }
}

// Méthode pour récupérer une catégorie par son id
public function getById($id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
        return $stmt->fetch();
    } catch (PDOException $e) {
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
        return false;
    }
}
// Méthode pour supprimer une catégorie
public function delete($id) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
}


?>