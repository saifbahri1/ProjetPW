<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
</head>

<body>
    <h1>Ajouter une catégorie</h1>
    <form method="post" action="../controllers/CategoryControllers/CategoryCreateController.php">

        <label for="name">Nom</label>
        <input type="text" name="name" id="name">

        <label for="shortCode">Code</label>
        <input type="text" name="shortCode" id="shortCode">

        <button type="submit">Ajouter</button>
        <a href="index.php">Annuler</a>

    </form>
</body>

</html>