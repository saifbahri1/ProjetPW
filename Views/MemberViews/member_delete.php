<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le licencié</title>
</head>
<body>
    <h1>Supprimer le licencié</h1>
    
    <p>Êtes-vous sûr de vouloir supprimer ce licencié  ?</p>
    
    <form method="post"  action="/adminApp/Controllers/MemberControllers/MemberDeleteController.php/?licenseNumber=<?= isset($_GET['licenseNumber']) ? $_GET['licenseNumber'] : ''; ?>">
       
        <div class="btn-container">
            <button type="submit" class="primary">Supprimer</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/MemberViews/member_list.php'">Annuler</button>
        </div>

    </form>
</body>
</html>
