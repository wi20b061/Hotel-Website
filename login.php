<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $loginErr = "";

    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        unset($_SESSION['username']);
        $_SESSION["loggedin"] = false;
        header('Location: /Semesterprojekt_Hotel_WEB/login.php');
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST["email"])
    && isset($_POST["password"]))
    {
        if($_POST["email"] == "admin@email"
        && $_POST["password"] == "1234"){
                $_SESSION["username"] = "admin";
                $_SESSION["loggedin"] = true;
        }
        elseif($_POST["email"] == "user1@email"
        && $_POST["password"] == "1234"){
            $_SESSION["username"] = "user1";
            $_SESSION["loggedin"] = true;
        }
        else{
            $loginErr = "Email or password is not correct";
        }
    }

    include 'webstructure/head.php';
?>
    <title>Login</title>
</head>
<body>
  <?php
    include 'webstructure/nav.php';
  ?>
    <br>
    <div class="container">
        <?php if(!isset($_SESSION["username"])): ?>
            <h1 class="page-header">Login</h1>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control"><br>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <span class="error"><?php echo $loginErr;?></span>
                <br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        <?php else:?>
            
            <h2>Hello,
                <div>
                    <?php echo $_SESSION["username"]?>

                    <?php if($_SESSION["username"] == "admin"): ?>
                    <img src="img/admin_icon.jpg" alt="icon for admin user" width="50" heigth="50">
                    <img src="img/admin_banner.jpg" alt="galaxy banner blue for admin user" heigth="50">

                    <?php elseif($_SESSION["username"] == "user1"): ?>
                    <img src="img/user1_icon.png" alt="icon for user1" width="50" heigth="50">
                    <img src="img/user1_banner.jpg" alt="galaxy banner lilac for user1" heigth="50">

                    <?php endif ?>
                </div>
            </h2>
            
            <a class="btn btn-primary" href="?logout=true">Logout</a>
        <?php endif?>
    
<?php
    include 'webstructure/footer.php';
?>
