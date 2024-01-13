<head>
    <meta charset="UTF-8">
    <title>Modifier la catégorie</title>
</head>

<body>
    <h1>Modifier la catégorie</h1>
    <form method="post" action="/adminApp/controllers/CategoryControllers/CategoryUpdateController.php?id=<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">

    <div class="field input">

        <label for="name">Nom</label>
        <input type="text" name="name" id="name" >
    </div>
        <div class="field input">

        <label for="shortCode">Code</label>
        <input type="text" name="shortCode" id="shortCode" >
        </div>
    
        <div class="btn-container">
            <button type="submit" class="primary">Modifier</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/category_list.php'">Annuler</button>
        </div>
    </form>
</body>

</html>