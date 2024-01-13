
<?php
include("/xampp/htdocs/adminApp/config.php");


?>
<head>
    <meta charset="UTF-8">
    <title>Modifier les informations relatives à ce contact</title>
</head>

<body>
    <h1>Modifier les informations relatives à ce contact</h1>
    <form method="post"  action="/adminApp/Controllers/ContactControllers/ContactUpdateController.php/?idContact=<?= isset($_GET['idContact']) ? $_GET['idContact'] : ''; ?>">

        <label for="firstName">Nom</label>
        <input type="text" name="firstName" id="firstName">

        <label for="lastName">Prénom</label>
        <input type="text" name="lastName" id="lastName">

        <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" >
                </div>
                <div class="field input">
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" >
                </div>


        <div class="btn-container">
            <button type="submit" class="primary">Modifier</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/ContactViews/contact_list.php'">Annuler</button>
        </div>

    </form>
</body>

</html>