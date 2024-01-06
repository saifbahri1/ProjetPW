<?php
class HomeController {
    private $categoryDAO;

    public function __construct(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

    public function index() {
        // RÃ©cupÃ©rer la liste de tous les contacts depuis le modÃ¨le
        $contacts = $this->categoryDAO->getAll();
print_r($contacts);
    }
}


require ("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/Models/Category.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
$categoryDAO=new CategoryDAO($conn);
$controller=new HomeController($categoryDAO);
$controller->index();

?>