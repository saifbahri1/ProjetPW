<head>
    <meta charset="UTF-8">
    <title>Modifier la catégorie</title>
</head>

<body>
    <h1>Modifier la catégorie</h1>
    <form method="post" action="../controllers/CategoryControllers/CategoryUpdateController.php?id=<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">

        <!-- Hidden input for id -->

        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?="ssss"  ?>">

        <label for="shortCode">Code</label>
        <input type="text" name="shortCode" id="shortCode" value="<?= "ss" ?>">

        <button type="submit">Modifier</button>
        <a href="index.php">Annuler</a>

    </form>
</body>

</html>