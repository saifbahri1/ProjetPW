<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Afficher la liste des catégories</title>
</head>
<body>
    <h1>Afficher la liste des catégories</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category->getName() ?></td>
                    <td><?= $category->getShortCode() ?></td>
                   >
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <a href="index.php?controller=category&action=create">Ajouter une catégorie</a>
</body>
