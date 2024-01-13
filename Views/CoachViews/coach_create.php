<?php
include("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");

$CategoryDAO = new CategoryDAO($conn);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un éducateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .field.select {
            position: relative;
        }

        .field.select label,
        .field.select select {
            width: 100%;
            display: block;
        }

        .field.select select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z" /></svg>') no-repeat right 8px center/18px auto;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-container button {
            width: calc(50% - 5px);
            padding: 10px;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-container button.primary {
            background-color: #000;
        }

        .btn-container button.secondary {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <h1>Ajouter un coach</h1>
    <form method="post" action="/adminApp/Controllers/CoachControllers/CoachCreateController.php">
        <!-- Fields for contact -->
        <div class="field input">
            <label for="firstName">Nom</label>
            <input type="text" name="firstName" id="firstName" required>
        </div>

        <div class="field input">
            <label for="lastName">Prénom</label>
            <input type="text" name="lastName" id="lastName">
        </div>
        <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="field input">
            <label for="phoneNumber">Numéro de téléphone</label>
            <input type="text" name="phoneNumber" id="phoneNumber">
        </div>

        <!-- Dynamic dropdown for categories -->
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

        <!-- Fields specific to coaches -->
     
        <div class="field input">
            <label for="coachPassword">Mot de passe</label>
            <input type="password" name="coachPassword" id="coachPassword" required>
        </div>
        <div class="field select">
            <label for="isAdmin">Est administrateur?</label>
            <select name="isAdmin" id="isAdmin" required>
                <option value="0">Non</option>
                <option value="1">Oui</option>
            </select>
        </div>
        <!-- Buttons -->
        <div class="btn-container">
            <button type="submit" class="primary">Ajouter</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/CoachViews/coach_list.php'">Annuler</button>
        </div>
    </form>
</body>

</html>
