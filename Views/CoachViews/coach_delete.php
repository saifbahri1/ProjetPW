<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'éducateur</title>
</head>

<body>
    <h1>Supprimer l'éducateur</h1>

    <p>Êtes-vous sûr de vouloir supprimer cet éducateur ?</p>

    <form method="post" action="/adminApp/Controllers/CoachControllers/CoachDeleteController.php/?licenseNumber=<?= isset($_GET['licenseNumber']) ? $_GET['licenseNumber'] : ''; ?>">

        <div class="btn-container">
            <button type="submit" class="primary">Supprimer</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/CoachViews/coach_list.php'">Annuler</button>
        </div>

    </form>
</body>

</html>
