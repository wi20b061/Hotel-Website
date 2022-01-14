<?php
    include 'webstructure/head.php';
    include 'webstructure/nav.php';
?>

 <?php

    //connect with DB
    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
        echo "Collection failed!";
        exit();}

     //update in DB
     if(isset($_POST["passwordNew"]) && isset($_GET["userID"]) && !empty($_GET["userID"])) { 

       $userID = intval($_GET['userID']);
 
       $sql = "UPDATE `user` SET `password`=?  WHERE `userID`=?";   
 
       $password = $_POST["passwordNew"];
     
       //use prepare function
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("si", $password, $userID );
    
        //executes the statement
        $stmt->execute();
        
        //close the statement
        $stmt->close();
    
        //close the connection
        $db_obj->close();
        header('Location: register.php');
        die();
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
                <label for="password1">Password</label>
                <input type="password" name="passwordOld"  class="form-control" id="password1" placeholder="Your Password">
            </div>
            <div class="form-group">
                <label for="password2">New Password</label>
                <input type="password" name="passwordNew"  class="form-control" id="password2" placeholder="Your new password">
            </div>
            <div class="form-group">
                <label for="password3">Retype New Password</label>
                <input type="password" name="passwordNewB"  class="form-control" id="password3" placeholder="Type in new password again">
            </div>
            <button type="submit" name="change" class="btn btn-primary">Apply Password Changes</button>

        </form>
</div>

</body>
<?php
    include 'webstructure/footer.php';
?>


