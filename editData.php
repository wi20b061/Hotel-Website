<?php
    include 'webstructure/head.php';

    $emailErr=$salutationErr=$fnameErr=$lnameErr=$usernameErr= "";
    $email=$salutation=$fname=$lname=$username= "";


    
    //conn with DB
    require_once('dbaccess.php');

    $db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
        echo "Collection failed!";
        exit();

    }


    if (isset($_GET["userID"]) && !empty(["userID"])) {

    
    //sql Abfrage from DB
    $sql = "SELECT user.fname, user.lname, user.email, user.username, 
    user.salutation FROM user WHERE userID = ? ;";

    $stmt = $db_obj->prepare($sql);

    $userID = intval($_GET['userID']);
    
    $stmt->bind_param('i', $userID);

    $stmt->execute();
    $stmt ->bind_result( $fname, $lname, $email, $username, 
    $salutation);

    $stmt->fetch();

    $stmt->close();

    } 


        //update in DB
        if(isset($_POST["userID"]) && !empty($_POST["userID"]) && isset($_POST["fname"]) && !empty($_POST["fname"])
        && isset($_POST["lname"]) && !empty($_POST["lname"])&& isset($_POST["username"]) && !empty($_POST["username"])
        && isset($_POST["email"]) && !empty($_POST["email"])&& isset($_POST["salutation"]) && !empty($_POST["salutation"])) {
    
           
          #$userID = intval($_GET['userID']);
          
          $userID = intval($_POST["userID"]);
    
          $sql = "UPDATE `user` SET `salutation`= ?, `email`= ?, `fname`= ?, `lname`= ?, `username`= ?  WHERE `userID`= ? ";    
         
          $lname = $_POST["lname"];
          $fname = $_POST["fname"];
          $username = $_POST["username"];
          $salutation = $_POST["salutation"];
          $email = $_POST["email"];

          
        //use prepare function
        $stmt = $db_obj->prepare($sql);


var_dump($stmt);

        $stmt->bind_param("sssssi", $salutation, $email, $fname, $lname, $username, $userID );

           
        //executes the statement
        $stmt->execute();
        
          //close the statement
        $stmt->close();
        //close the connection
        $db_obj->close();
        header('Location: ?userID='. $userID);
        die();
        }

?>

<head>
<title>Update your profile</title>
</head>
<body>
      
  <?php
    include 'webstructure/nav.php';
  ?>
 
 <br>

 <div class="container text-center">
     <h1 id = "heading-1">Update your profile </h1>
</div>
<br>


<div class=container>

<div class="sickbg container jumbotron">
    
    <form name="kiki" action="#" method="post"> 
    
    <div class="form-group col-md-4">
                  <label for="salutation">Salutation</label>
                  <span class="error">* <?php echo $salutationErr;?></span>
                  <select autocomplete="off" id="salutation" name="salutation" class="form-control" value="<?php echo $salutation;?>">
                    <!--shows actuall salutation, if there is one, if not - first option will be shown-->
                    <option  <?php if ($salutation=="Mrs.") {echo "selected"; }?> value="1" >Mrs.</option>
                    <option  <?php if ($salutation=="Ms.") {echo "selected"; }?> value="1" >Ms.</option>
                    <option  <?php if ($salutation=="Mr.") {echo "selected"; }?> value="1" >Mr.</option>
                    <option  <?php if ($salutation=="Dr.") {echo "selected"; }?> value="1" >Dr.</option>
                  </select>
      </div>

    <div class="form-group ">
        <label for="fname">First name:</label>
        <span class="error">* <?php echo $fnameErr;?></span>
        <input  class="form-control" name="fname" type="text" id="fname" placeholder="First name"  value="<?php echo $fname; ?>" required/>
    
        <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
    </div>

    <div class="form-group ">
        <label for="lname">Lastname:</label>
        <span class="error">* <?php echo $lnameErr;?></span>
        <input  class="form-control" name="lname" type="text" id="lname" placeholder="Last name" value="<?php echo $lname; ?>" required/>
        
        <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
    </div>

    <div class="form-group ">
        <label for="username">Username:</label>
        <span class="error">* <?php echo $usernameErr ;?></span>
        <input  class="form-control" name="username" type="text" id="username" placeholder="User name"  value="<?php echo $username; ?>" required />
    
        <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
    </div> 

    <div class="form-group " >
        <label for="email">E-Mail-Address:</label>
        <span class="error">* <?php echo $emailErr;?></span>
        <input  class="form-control" name="email" type="email" id="email" placeholder="E-Mail-Adresse" value="<?php echo $email; ?>" required/>
    
        <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
    </div> 

    <button type='submit' name='submit' class='btn btn-primary' value="id"> Update </button>
    
    </form>
</div> 


</body>
<?php
    include 'webstructure/footer.php';
?>
