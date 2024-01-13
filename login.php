<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
                include("/xampp/htdocs/adminApp/config.php");

                if(isset($_POST['submit'])){
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);

                    try {
                        $stmt = $conn->prepare("SELECT * FROM coaches WHERE Email = :email AND Password = :password");
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':password', $password);
                        $stmt->execute();
                        
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if($row){
                            $_SESSION['valid'] = $row['email'];
                            $_SESSION['username'] = $row['firstName'];
                   
                            $_SESSION['id'] = $row['licenseNumber'];
                        } else {
                            echo "<div class='message'>
                                    <p>Wrong Username or Password</p>
                                </div> <br>";
                            echo "<a href='index.php'><button class='btn'>Go Back</button>";
                        }

                        if(isset($_SESSION['valid'])){
                            header("Location: home.php");
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
            ?>
            <header>Se Connecter</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Mot de passe </label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" style="background-color:#0d6efd!important" name="submit" value="Se connecter" required>
                </div>
                <div class="links">
                    Vous n'avez pas de compte? <a href="register.php">S'inscrire</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>