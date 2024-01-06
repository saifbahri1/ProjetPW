<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la catégorie</title>
</head>
<body>
    <h1>Modifier la catégorie</h1>
    <form method="post" action="index.php?controller=category&action=update&id=<?= $category->getIdCategory() ?>">

        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="<?= $category->getName() ?>">

        <label for="shortCode">Code</label>
        <input type="text" name="shortCode" id="shortCode" value="<?= $category->getShortCode() ?>">

        <button type="submit">Modifier</button>
        <a href="index.php">Annuler</a>

    </form>