

<?php
include("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");

$CategoryDAO = new CategoryDAO($conn);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier les informations relatives à ce coach</title>
</head>

<body>
    <h1>Modifier les informations relatives à cet éducateur</h1>
    <form method="post" action="/adminApp/Controllers/CoachControllers/CoachUpdateController.php/?licenseNumber=<?= isset($_GET['licenseNumber']) ? $_GET['licenseNumber'] : ''; ?>">
       
    <div class="field input">
        <label for="firstName">Nom</label>
        <input type="text" name="firstName" id="firstName">
    </div>
    <div class="field input">
        <label for="lastName">Prénom</label>
        <input type="text" name="lastName" id="lastName">
        </div>

        <div class="field input">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        </div>

        <div class="field input">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
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
        <div class="field select">
            <label for="isAdmin">Est administrateur?</label>
            <select name="isAdmin" id="isAdmin" required>
                <option value="0">Non</option>
                <option value="1">Oui</option>
            </select>
        </div>




        <div class="btn-container">
            <button type="submit" class="primary">Modifier</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/CoachViews/coach_list.php'">Annuler</button>
        </div>
    </form>
</body>

</html>
