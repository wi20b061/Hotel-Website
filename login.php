<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $loginErr = "";

    //falls sich jemand ausloggt, wird die userID aus der Session gelöscht
    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        unset($_SESSION['userID']);
        unset($_SESSION["userrole"]);
        unset($_SESSION["username"]);
        header('Location: login.php');
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //DB connection
        require_once ('dbaccess.php');
        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        
        //check username & password with DB
        if(!isset($_POST["username"]) || !isset($_POST["password"]) || empty($_POST["username"]) || empty($_POST["password"])){
            $loginErr = "Username or Password was not set.";
        }else{
            $username = test_input($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);
            
            $sql = "SELECT `password`, `userID`, `roleID` FROM `user` WHERE `username` = ? AND `active`= 1";

            //use prepare function
            $stmt = $db_obj->prepare($sql);
            //followed by the variables which will be bound to the parameters
            $stmt-> bind_param("s", $username);
            //execute statement
            $stmt->execute();
            
            $stmt ->bind_result($passwordDB, $userID, $userrole);
            $stmt->fetch();

            if(!empty($passwordDB) && password_verify($_POST["password"], $passwordDB)){
                $_SESSION["userID"] = $userID;
                $_SESSION["username"] = $username;
                $_SESSION["userrole"] = $userrole;
                //close the statement
                $stmt->close();
            
                /*$sql = "SELECT `roleID`  FROM `user` WHERE `userID` = ?";
                //use prepare function
                $stmt = $db_obj->prepare($sql);
                //followed by the variables which will be bound to the parameters
                $stmt-> bind_param("i", $userID);
                //execute statement
                $stmt->execute();
                
                $stmt ->bind_result($userrole);
                $stmt->fetch();

                $_SESSION["userrole"] = $userrole;
                //close the statement
                $stmt->close();*/
            }else{
                $loginErr = "Username or Password was not correct.<br> Or your account was deactivated.";
            }

            /*//$password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "SELECT `userID`  FROM `user` WHERE `username` = ? AND `password`= ? AND `active`= 1";
            //use prepare function
            $stmt = $db_obj->prepare($sql);
            //followed by the variables which will be bound to the parameters
            $stmt-> bind_param("ss", $username, $password);
            //execute statement
            $stmt->execute();
            
            $stmt ->bind_result($userID);
            $stmt->fetch();
            

            if(empty($userID)){
                $loginErr = "Username or Password was not correct.<br> Or your account was deactivated.";
            }else{
                $_SESSION["userID"] = $userID;
                $_SESSION["username"] = $username;
                //close the statement
                $stmt->close();
            
                $sql = "SELECT `roleID`  FROM `user` WHERE `userID` = ?";
                //use prepare function
                $stmt = $db_obj->prepare($sql);
                //followed by the variables which will be bound to the parameters
                $stmt-> bind_param("i", $userID);
                //execute statement
                $stmt->execute();
                
                $stmt ->bind_result($userrole);
                $stmt->fetch();

                $_SESSION["userrole"] = $userrole;
                echo $_SESSION["userrole"];
                //close the statement
                $stmt->close();
            }*/
            
            //close the connection
            $db_obj->close();
        }

    
    }
    function test_input($data){
        $data = trim($data); //unnötige leerzeichen etc entfernen
        $data = stripslashes($data); //Backlashes entfernen vom unser input
        $data = htmlspecialchars($data); //zu htmlspecialchars machen (Security reasons)
        return $data;
    }

    include 'webstructure/head.php';
?>
    <title>Login</title>
</head>
<body>
<div style="background-image: url('uploads/background.jpg');">
  <?php
    include 'webstructure/nav.php';
  ?>
    <br>
    <div class="container">
        <?php if(!isset($_SESSION["userID"])): ?>
            <h1 class=" page-header text-light">Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label class="text-light" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control"><br>
                    <label class="text-light" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <span class="error"><?php echo $loginErr;?></span>
                <br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        <?php else:?>
            <h2 class="text-light">Hello, <?php echo $_SESSION["username"]?>!</h2>
                <div class="text-light">
                    Push the button "Logout" to logout from your profil.
                </div><br>
            
            
            <a class="btn btn-primary" href="?logout=true">Logout</a>
        <?php endif?>
    </div>
</div>
    
<?php
    include 'webstructure/footer.php';
?>
