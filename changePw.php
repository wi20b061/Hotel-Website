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
        exit();}
?>

<?php
     //update in DB
     if(isset($_POST["passwordNew"]) && !empty($_POST["passwordNew"]) && isset($_GET["userID"]) && !empty($_GET["userID"])) { 


        
        //get pw from db
        
        $userID = '7'; #intval($_POST['userID']);
        #$userID = $_SESSION['userID'];  read userID from Session

        $request = "SELECT user.password FROM user WHERE user.userID = ?";

        $stmt = $db_obj->prepare($request);

        $stmt->bind_param("s", $pw );

        $stmt->execute();
        echo $pw;

        // the password is protected in form of hash output
        $hash = password_hash($_POST["passwordOld"], PASSWORD_BCRYPT);

        //change button is selected
        # if (isset($_POST["change"])){
        //old password check
        if ( password_verify($_POST["passwordOld"], $pw )) {

                    //password confirmation
                    if ($_POST["passwordNew"] != $_POST["passwordNewB"] ) {
                        echo '<div class="alert alert-danger alert-dismissible">The password is not the same!</div>';
                    }
                    //verify the new password
                    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d\w\W]{4,}$/",$_POST["passwordNew"])) {
                        echo '<div class="alert alert-danger alert-dismissible">Minimum four letters = 1 character and 1 numerical value</div>';
                        $err=true;
                    }
                    else{
                        // the password is protected in form of hash output
                        $hash = password_hash($_POST["passwordNew"], PASSWORD_BCRYPT);

                $userID = intval($_GET['userID']);
            
                $sql = "UPDATE `user` SET `password`=?  WHERE `userID`=?";   
            
                # $password = $_POST["passwordNew"];
                
                //use prepare function
                    $stmt = $db_obj->prepare($sql);
                    $stmt->bind_param("si", $hash, $userID );
                
                    //executes the statement
                    $stmt->execute();

                    if ($stmt->execute()) {
                        header('Location: register.php');
                        die();
                        }
            else {
                echo '<div class="alert alert-danger alert-dismissible">The old password is not the same!</div>';
            echo "Try again";
            
            }
            
        //close the statement
        $stmt->close();
    
        //close the connection
        $db_obj->close();

        }
     }

     else{
         $error ="Try again";
         die("Old passwort is wrong");
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

