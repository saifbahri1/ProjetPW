<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-container button {
            width: calc(50% - 5px);
            padding: 10px;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-container button.primary {
            background-color: #000;
        }

        .btn-container button.secondary {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <h1>Ajouter une catégorie</h1>
    <form method="post" action="../controllers/CategoryControllers/CategoryCreateController.php">

        <label for="name">Nom</label>
        <input type="text" name="name" id="name" required>

        <label for="shortCode">Code</label>
        <input type="text" name="shortCode" id="shortCode" required>

        <div class="btn-container">
            <button type="submit" class="primary">Ajouter</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/category_list.php'">Annuler</button>
        </div>

    </form>
</body>

</html>
