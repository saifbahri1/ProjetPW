<?php
class CategoryController {
    private $CategoryDAO;

    public function __construct(CategoryDAO $CategoryDAO) {
        $this->CategoryDAO = $CategoryDAO;
    }

    public function listCategories() {
        $categories = $this->CategoryDAO->getAll();
        include 'views/category_list.php';
    }

    public function showCategory($id) {
        $category = $this->CategoryDAO->getById($id);

        if (!$category) {
            echo "La catégorie n'a pas été trouvé.";
            return;
        }

        include 'views/category_show.php';
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category(null, $_POST['name'], $_POST['shortCode']);
            $this->CategoryDAO->create($category);
            
            $this->listCategories();
        } else {
            include 'views/category_create.php';
        }
    }
    
    public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category($_POST['id'], $_POST['name'], $_POST['shortCode']);
            $this->CategoryDAO->update($category);
            
            $this->listCategories();
        } else {
            $category = $this->CategoryDAO->getById($_GET['id']);
            
            if (!$category) {
                echo "La catégorie n'a pas été trouvé.";
                return;
            }
            
            include 'views/category_update.php';
        }
    }
    

    public function deleteCategory($id) {
         // Récupérer le contact à supprimer en utilisant son ID
         $category = $this->CategoryDAO->getById($id);

         if (!$category) {
             // Le contact n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
             echo "La catégorie n'a pas été trouvé.";
             return;
         }
 
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // Supprimer le contact en appelant la méthode du modèle (ContactDAO)
             if ($this->CategoryDAO->delete($id)) {
                 header('Location:index.php');
                 exit();
             } else {
                 echo "Erreur lors de la suppression de la catégorie.";
             }
         }
 
            include 'views/category_delete.php';
    }


}