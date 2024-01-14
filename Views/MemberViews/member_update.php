
<?php
include("/xampp/htdocs/adminApp/config.php");
require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");
require_once("/xampp/htdocs/adminApp/DAO/MemberDAO.php");

require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php");


$CategoryDAO = new CategoryDAO($conn);
$contactDAO=new ContactDAO($conn);
$MemberDAO = new MemberDAO($conn);

$member=$MemberDAO->getByLicenseNumber($_GET['licenseNumber'],$CategoryDAO,$contactDAO);
?>
<head>
    <meta charset="UTF-8">
    <title>Modifier les informations relatives à ce licencié</title>
</head>

<body>

    
    <h1>Modifier les informations relatives à ce licencié</h1>
    <form method="post" action="/adminApp/Controllers/MemberControllers/MemberUpdateController.php/?licenseNumber=<?= isset($_GET['licenseNumber']) ? $_GET['licenseNumber'] : ''; ?>">

        <label for="firstName">Nom</label>
        <input type="text" name="firstName" id="firstName" value=<?php echo $member->getFirstName() ?>>

        <label for="lastName">Prénom</label>
        <input type="text" name="lastName" id="lastName" value=<?php echo $member->getlastName() ?>>

        <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=<?php echo $member->getContact()->getEmail() ?>>
                </div>
                <div class="field input">
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" value=<?php echo $member->getContact()->getPhoneNumber() ?>>
                </div>

        <div class="field select">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category" required value=<?php echo $member->getCategory()->getName() ?>>
                        <?php
                        $categories = $CategoryDAO->getAll();
                        foreach ($categories as $category) {
                            echo "<option>" . $category->getName() . "</option>";
                        }
                        ?>
                    </select>
                </div>


        <div class="btn-container">
            <button type="submit" class="primary">Modifier</button>
            <button type="button" class="secondary" onclick="window.location.href='/adminApp/Views/MemberViews/member_list.php'">Annuler</button>
        </div>

    </form>
</body>

</html>