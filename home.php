
<?php
 session_start();

 include("/xampp/htdocs/adminApp/config.php");
 if(!isset($_SESSION['valid'])){
     header("Location: index.php");
 }
class HomeController {
    private $categoryDAO;

    public function __construct(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

    public function index() {
        // RÃ©cupÃ©rer la liste de tous les contacts depuis le modÃ¨le
        $contacts = $this->categoryDAO->getAll();
        foreach ($contacts as $category) {
            echo $category->getName() ;
        }

    }
}


require ("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/Models/Category.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
$categoryDAO=new CategoryDAO($conn);
$controller=new HomeController($categoryDAO);
$controller->index();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Rennes Sport Club</a></p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];

            try {
                $stmt = $conn->prepare("SELECT * FROM coaches WHERE licenseNumber = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $res_Uname = $result['firstName'];
                    $res_Email = $result['email'];
                    $res_id = $result['licenseNumber'];
                }

                echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
       
          </div>
   
       </div>

    </main>
</body>
</html>