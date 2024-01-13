<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le contact</title>
</head>
<body>
    <h1>Supprimer le contact</h1>
    
    <p>Êtes-vous sûr de vouloir supprimer ce contact ?</p>
    
    <form method="post"  action="/adminApp/Controllers/ContactControllers/ContactDeleteController.php?idContact=<?=isset($_GET['idContact']) ? $_GET['idContact'] : ''; ?>">
        <div class="btn-container">
            <button type="submit" class="primary">Supprimer</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/ContactViews/contact_list.php'">Annuler</button>
        </div>

    </form>
</body>
</html>
