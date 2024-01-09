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

</head>

<body>
    <nav class="navbar navbar-light justify-content-left fs-3 mb-5"
        style="background-color: #0d6efd; color:white; padding-left:10px ;font-size:30px!important">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top" style="color:white!important">Rennes Sports Club</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a style="font-size: 20px!important;color:black !important; " class="nav-link"
                            href="../adminApp/Views/category_list.php">Catégories</a></li>
                    <li class="nav-item"><a style="font-size: 20px!important;color:black !important; " class="nav-link"
                            href="#services">Educateurs</a></li>
                    <li class="nav-item"><a style="font-size: 20px!important;color:black !important; " class="nav-link"
                            href="#portfolio">Membres</a></li>
                    <li class="nav-item"><a style="font-size: 20px!important;color:black !important; " class="nav-link"
                            href="#contact">Contacts</a></li>
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
        <!-- Add New Category Button -->
        <button type="button" class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add
            New</button>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Include your add category form here -->
                        <?php include("/xampp/htdocs/adminApp/Views/category_create.php"); ?>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col"> Name</th>
                    <th scope="col">Short Code</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include("/xampp/htdocs/adminApp/config.php");
                include("/xampp/htdocs/adminApp/DAO/CategoryDAO.php");  
                
                $CategoryDAO = new CategoryDAO($conn);
                $categories=$CategoryDAO->getAll();
                
                foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category->getName(); ?></td>
                    <td><?= $category->getShortCode(); ?></td>
                    <td>
                        <!-- Update Button -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?= $category->getIdCategory(); ?>">
    Update
</button>
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $category->getIdCategory(); ?>">
                            Delete
                        </button>
                    </td>
                </tr>


<!-- Update Modal -->
<div class="modal fade" id="updateModal<?= $category->getIdCategory(); ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $category->getIdCategory(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel<?= $category->getIdCategory(); ?>">Modifier la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container for dynamic content -->
                <div id="updateFormContainer"></div>

                <!-- JavaScript to load the update form dynamically -->
                <script>
                    // Function to load update form dynamically
                    function loadUpdateForm(categoryId) {
                        // Use AJAX to fetch the update form content
                        // Adjust the URL accordingly
                        fetch(`/adminApp/Views/category_update.php?id=${categoryId}`)
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
                    document.getElementById('updateModal<?= $category->getIdCategory(); ?>').addEventListener('shown.bs.modal', function () {
                        loadUpdateForm(<?= $category->getIdCategory(); ?>);
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal<?= $category->getIdCategory(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $category->getIdCategory(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?= $category->getIdCategory(); ?>">Supprimer la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Container for dynamic content -->
                <div id="deleteFormContainer<?= $category->getIdCategory(); ?>"></div>

                <!-- JavaScript to load the delete form dynamically -->
                <script>
                    // Function to load delete form dynamically
                    function loadDeleteForm(categoryId) {
                        // Use AJAX to fetch the delete form content
                        // Adjust the URL accordingly
                        fetch(`/adminApp/Views/category_delete.php?id=${categoryId}`)
                            .then(response => response.text())
                            .then(data => {
                                // Set the content inside the container
                                document.getElementById(`deleteFormContainer${categoryId}`).innerHTML = data;
                            })
                            .catch(error => {
                                console.error('Error fetching delete form:', error);
                            });
                    }

                    // Trigger the function when the modal is shown
                    document.getElementById(`deleteModal<?= $category->getIdCategory(); ?>`).addEventListener('shown.bs.modal', function () {
                        loadDeleteForm(<?= $category->getIdCategory(); ?>);
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