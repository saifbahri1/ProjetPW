
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
       

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        /* Custom styling for the title */
        .page-title {
            font-size: 40px;
            font-weight: bold; /* Make the text bold */
            color: #333; /* Choose your preferred text color */
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-light justify-content-left fs-3 mb-5"
        style="background-color: #000; color:white; padding-left:10px ;font-size:35px!important">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/adminApp/index.php" style="color:white!important">Rennes Sports Club</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation" style="background-color: white !important;"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a style="font-size: 15px!important;color:white !important; " class="nav-link"
                            href="../category_list.php">Catégories</a></li>
                    <li class="nav-item"><a style="font-size: 15px!important;color:white !important; " class="nav-link"
                            href="../CoachViews/coach_list.php">Educateurs</a></li>
                    <li class="nav-item"><a style="font-size: 15px!important;color:white !important; " class="nav-link"
                            href="../MemberViews/member_list.php">Membres</a></li>
                    <li class="nav-item"><a style="font-size: 15px!important;color:white !important; " class="nav-link"
                            href="../ContactViews/contact_list.php">Contacts</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2 class="page-title text-center">Gestion des licenciés</h2>

        <!-- Add New Member Button -->
        <div class="text-center">
    <button type="button" class="btn btn-dark mb-3" style="width: 120px; display: block; margin: 0 auto;" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Ajouter</button>
</div>
        <!-- Add Member Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Ajouter un nouveau membre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Include your add Member form here -->
                        <?php include("/xampp/htdocs/adminApp/Views/MemberViews/member_create.php"); ?>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Numéro de licence</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                include("/xampp/htdocs/adminApp/config.php");
                include("/xampp/htdocs/adminApp/DAO/MemberDAO.php");  
                require_once("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  
                require_once("/xampp/htdocs/adminApp/DAO/ContactDAO.php");  
                $categoryDAO = new CategoryDAO($conn);
                $contactDAO = new ContactDAO($conn);

                $MemberDAO = new MemberDAO($conn);
                $members=$MemberDAO->getAll($categoryDAO,$contactDAO);
                
                foreach ($members as $member): ?>
                <tr>
                    <td><?= $member->getLicenseNumber(); ?></td>
                    <td><?= $member->getFirstName(); ?></td>
                    <td><?= $member->getLastName(); ?></td>
                    <td><?= $member->getContact()->getEmail(); ?></td>
                    <td><?= $member->getCategory()->getName(); ?></td>
                    <td>
                        <!-- Update Button -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?= $member->getLicenseNumber(); ?>">
    Modifier
</button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $member->getLicenseNumber(); ?>">
                            Supprimer
                        </button>
                    </td>
                </tr>


<!-- Update Modal -->
<div class="modal fade" id="updateModal<?= $member->getLicenseNumber(); ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $member->getLicenseNumber(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel<?= $member->getLicenseNumber(); ?>">Modifier le licencié</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container for dynamic content -->
                <div id="updateFormContainer"></div>

                <!-- JavaScript to load the update form dynamically -->
                <script>
                    // Function to load update form dynamically
                    function loadUpdateForm(licenseNumber) {
                        // Use AJAX to fetch the update form content
                        // Adjust the URL accordingly
                        fetch(`/adminApp/Views/MemberViews/member_update.php?licenseNumber=${licenseNumber}`)
                            .then(response => response.text())
                            .then(data => {
                                // Set the content inside the container
                                document.getElementById('updateFormContainer').innerHTML = data;
                            })
                            .catch(error => {
                                console.error('Error fetching update form:', error);
                            });
                    }

                    // Trigger the function when the modal is shown
                    document.getElementById('updateModal<?= $member->getLicenseNumber(); ?>').addEventListener('shown.bs.modal', function () {
                        loadUpdateForm(<?= $member->getLicenseNumber(); ?>);
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal<?= $member->getLicenseNumber(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $member->getLicenseNumber(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?= $member->getLicenseNumber(); ?>">Supprimer le licencié</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container for dynamic content -->
                <div id="deleteFormContainer<?= $member->getLicenseNumber(); ?>"></div>

                <!-- JavaScript to load the delete form dynamically -->
                <script>
                    // Function to load delete form dynamically
                    function loadDeleteForm(licenseNumber) {
                        // Use AJAX to fetch the delete form content
                        // Adjust the URL accordingly
                        fetch(`/adminApp/Views/MemberViews/member_delete.php?licenseNumber=${licenseNumber}`)
                            .then(response => response.text())
                            .then(data => {
                                // Set the content inside the container
                                document.getElementById(`deleteFormContainer${licenseNumber}`).innerHTML = data;
                            })
                            .catch(error => {
                                console.error('Error fetching delete form:', error);
                            });
                    }

                    // Trigger the function when the modal is shown
                    document.getElementById(`deleteModal<?= $member->getLicenseNumber(); ?>`).addEventListener('shown.bs.modal', function () {
                        loadDeleteForm(<?= $member->getLicenseNumber(); ?>);
                    });
                </script>
            </div>
        </div>
    </div>
</div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>