
<?php
include("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");

$CategoryDAO = new CategoryDAO($conn);

?>
<head>
    <meta charset="UTF-8">
    <title>Modifier les informations relatives à ce licencié</title>
</head>

<body>
    <h1>Modifier les informations relatives à ce licencié</h1>
    <form method="post" action="/Controllers/MemberControllers/MemberUpdateController.php?licenseNumber=<?= isset($_GET['licenseNumber']) ? $_GET['licenseNumber'] : ''; ?>">

        <label for="firstName">Nom</label>
        <input type="text" name="firstName" id="firstName">

        <label for="lastName">Prénom</label>
        <input type="text" name="lastName" id="lastName">

        <label for="contact">Contact</label>
        <input type="text" name="contact" id="contact">

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


        <div class="btn-container">
            <button type="submit" class="primary">Modifier</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/MemberViews/member_list.php'">Annuler</button>
        </div>

    </form>
</body>

</html>