<?php
    include 'webstructure/head.php';
    include 'webstructure/nav.php';
?>

 <?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //connect with DB
    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
        echo "Collection failed!";
        exit();
    }

    //update in DB
    if(isset($_POST["passwordNew"]) && !empty($_POST["passwordNew"]) && isset($_GET["userID"]) 
    && !empty($_GET["userID"]) && isset($_SESSION["userID"])) { 
        //get pw from db
        //$userID = '7'; //simmulation
       // $userID = $_SESSION['userID'];  //read userID from Session

        $request = "SELECT user.password FROM user WHERE user.userID = ?";

        //use prepared stmt
        $stmt = $db_obj->prepare($request);
        $stmt->bind_param("s", $_GET["userID"] );

        //execute stmt
        $stmt->execute();

        $stmt->bind_result($pw);
        $stmt->fetch();
        
               
        // the password is protected in form of hash output
      //  $hash = password_hash($_POST["passwordOld"], PASSWORD_BCRYPT);

        //old password check
       if (password_verify($_POST["passwordOld"], $pw)) {
      
            //close the statement
            $stmt->close();

            //password confirmation
            if ($_POST["passwordNew"] != $_POST["passwordNewB"] ) {
                echo '<p class="error">The password is not the same!</p>';
            }
            //verify the new password
            /*if (!preg_match("/^(?=.?[A-Z])(?=.?[a-z])(?=.?[0-9])(?=.?[#?!@$%^&*-]).{8,}$/",$_POST["passwordNew"])) {
                echo '<div class="alert alert-danger alert-dismissible">Minimum four letters = 1 character and 1 numerical value</div>';
                $err=true;
            }*/
            else{
                // the password is protected in form of hash output
                $hash = password_hash($_POST["passwordNew"], PASSWORD_BCRYPT);

                $userID = intval($_GET['userID']);
                $sql = "UPDATE `user` SET `password`=?  WHERE `userID`=?";   
                                         
                //use prepare function
                $stmt = $db_obj->prepare($sql);
                $stmt->bind_param("si", $hash, $userID );
                //executes the statement
                $stmt->execute();

                if ($stmt->execute()) {
                    header('Location: register.php');
                    die();
                }else{
                    echo '<div class="alert alert-danger alert-dismissible">The old password is not the same!</div>';
                    echo "Try again";
                }  
                //close the statement
                $stmt->close();
                //close the connection
                $db_obj->close();
            }
        }else{
            echo '<div class="alert alert-danger alert-dismissible">Old passwort is wrong</div>';
           
        }
   }
?>


<title>Update your password</title>
</head>
<body>
      
<br>

 <div class="container text-center">
     <h1 id = "heading-1">Update your password </h1>
</div>
<br>

<h3 class="text-center">Changing Your Password</h3>
<div class="sickbg container jumbotron">
        <form class="px-4 py-3" method="post" action="#" >
            <div class="form-group">
                <label for="password1">Password</label> <!--asking for old pw-->
                <input type="password" name="passwordOld"  class="form-control" id="password1" placeholder="Your Password">

            </div>
            <div class="form-group">
                <label for="password2">New Password</label> <!--asking for new pw-->
                <input type="password" name="passwordNew"  class="form-control" id="password2" placeholder="Your new password">
            </div>
            <div class="form-group">
                <label for="password3">Retype New Password</label> <!--asking for repeating a new pw-->
                <input type="password" name="passwordNewB"  class="form-control" id="password3" placeholder="Type in new password again">
            </div>
            <button type="submit" name="change" class="btn btn-primary">Apply Password Changes</button>

        </form>
</div>

</body>
<?php
    include 'webstructure/footer.php';
?>

