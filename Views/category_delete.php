<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer la catégorie</title>
</head>
<body>
    <h1>Supprimer la catégorie</h1>
    
    <p>Êtes-vous sûr de vouloir supprimer la catégorie  ?</p>
    
    <form method="post"  action="/adminApp/controllers/CategoryControllers/CategoryDeleteController.php?id=<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
        
        <div class="btn-container">
            <button type="submit" class="primary">Supprimer</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/category_list.php'">Annuler</button>
        </div>
    </form>
</body>
</html>
