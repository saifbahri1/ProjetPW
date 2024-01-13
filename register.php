<?php 
session_start();

include("/xampp/htdocs/adminApp/config.php");
include("/xampp/htdocs/adminApp/Models/Coach.php");  
include("/xampp/htdocs/adminApp/Models/Contact.php"); 
include("/xampp/htdocs/adminApp/DAO/CoachDAO.php");  
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  

$CategoryDAO = new CategoryDAO($conn);
$coachDAO = new CoachDAO($conn);
$ContactDAO = new ContactDAO($conn);

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $categoryName = $_POST['category'];

    // Verifying the unique email
    $verify_query = $coachDAO->getByEmail($email, $ContactDAO, $CategoryDAO);

    if ($verify_query) {
        // Display a pop-up with the error message
        echo '<script>alert("This email is already used. Please try another one.");</script>';
    } else {
        // Creating a Coach object
        $category = $CategoryDAO->getByName($categoryName);
        $contact = new Contact(null, $firstname, $lastname, $email, $phoneNumber);
        $coach = new Coach(NULL, $firstname, $lastname, $contact, $category, $email, $password,false);

        // Using the DAO to create a coach
        if ($coachDAO->create($coach)) {
            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
        } else {
            echo "<div class='message'>
                      <p>Error occurred during registration</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        }
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="firstname">Nom</label>
                    <input type="text" name="firstname" id="firstname" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="lastname">Prénom</label>
                    <input type="text" name="lastname" id="lastname" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field select">
            <label for="category">Catégorie</label>
            <select name="category" id="category" required>
                <?php
                $categories = $CategoryDAO->getAll();
                foreach ($categories as $category) {
                    echo "<option>" . $category->getName() . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="field">
    <input type="submit" style="background-color:#0d6efd!important" class="btn" name="submit" value="Register" onclick="window.location.href='/adminApp/login.php'" required>
</div>
                <div class="links">
                    Déjà un licencié ? <a href="index.php">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
    <script>


</script>
   
</body>
</html>
<?php } ?>