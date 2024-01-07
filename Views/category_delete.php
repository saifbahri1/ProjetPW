<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer la catégorie</title>
</head>
<body>
    <h1>Supprimer la catégorie</h1>
    
    <p>Êtes-vous sûr de vouloir supprimer la catégorie <strong><?= $category->getName() ?></strong> ?</p>
    
    <form method="post" action="index.php?controller=category&action=delete&id=<?= $category->getIdCategory() ?>">
        <button type="submit">Supprimer</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>
