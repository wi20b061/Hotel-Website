<?php

session_start();

if (isset($_GET['logout']) && $_GET['logout'] == true) {

    
    unset($_SESSION['username']);// if we logout a user we want to unset the session variable for the user
     
    header("Location: http://localhost/Hotel-Website-feature-grundstruktur-website/login.php"); // redirect to the defined location
 
    die();// output a message and terminate the current script
    
}

// check if the post parameter
    // username and password is set
    // and equals to "admin"

if($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["username"]) &&
    isset($_POST["password"]) &&
    $_POST["username"] == "admin" &&
    $_POST["password"] == "admin" 
    )

{
    // create a session variable user 
   // $_SESSION["username"] == $_POST["username"];
    //$_SESSION["password"] == $_POST["password"];

    $_SESSION['username'] = 'admin';

}
 
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Log In</title>
</head>
<body>

    <?php
        include('nav.php');
    ?>

    <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Login</h1>
                    </div>
                </div>
                <?php if (!isset($_SESSION["username"])): ?>
                    <form method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                <?php else: ?><!--//will show the name of setted user
        //diff pics for diff user -->
                    <h2>     
                    Hello
                    <span class="badge bg-secondary"> <?php echo $_SESSION["username"] ?></span>
                    <img src="./admin.jpg" class="rounded mx-auto d-block" 
                    alt="admin" width="400">
                    </h2>
                    <a class="btn btn-primary" href="?logout=true">Logout</a>
                <?php endif ?>
            </div>

</body>
</html>