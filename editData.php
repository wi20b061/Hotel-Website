<?php
  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
  include 'webstructure/head.php';

  $emailErr=$fnameErr=$lnameErr= "";
  $email=$salutation=$fname=$lname=$username=$usertype= "";
  
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
    user.salutation, user.active, user.roleID FROM user WHERE userID = ? ;";

    //use prepare function
    $stmt = $db_obj->prepare($sql);
    $userID = intval($_GET['userID']);
    $stmt->bind_param('i', $userID);
    
    //executes the statement
    $stmt->execute();
    $stmt->bind_result($fname, $lname, $email, $username, $salutation, $activation, $usertype);
    $stmt->fetch();
    
    //close the connection
    $stmt->close();
  }


  if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    //validation
      if(empty($_POST["email"])){
        $emailErr = "Email is required";
      }else{
        $email = test_input($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $emailErr = "Invalid email format";
        }
      }
      if(empty($_POST["fname"])){
        $fnameErr = "First name is required";
      }else{
        $fname = test_input($_POST["fname"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$fname)){ 
          $nameErr = "Only letters and whitespace allowed";
        }
      }
      if(empty($_POST["lname"])){
        $lnameErr = "Last name is required";
      }else{
        $lname = test_input($_POST["lname"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$lname)){ 
          $nameErr = "Only letters and whitespace allowed";
        }
      }
      
    //update in DB
    if(!empty($_POST["userID"]) && !empty($_POST["fname"])
    && !empty($_POST["lname"]) && !empty($_POST["email"])) {
      
      if($_POST["userType"] == "Admin"){
        $usertype = 1;
      }else if($_POST["userType"] == "Normal User"){
        $usertype = 3;
      }else{
        $usertype = 2;
      }
      if($_POST["activation"] == "Activated"){
        $activation = 1;
      }else{
        $activation = 0;
      }
      $userID = intval($_POST["userID"]);
      $sql = "UPDATE `user` SET `salutation`= ?, `email`= ?, `fname`= ?, `lname`= ?, `roleID`= ? ,`active`= ?  WHERE `userID`= ? ";    
      
      $lname = $_POST["lname"];
      $fname = $_POST["fname"];
      $salutation = $_POST["salutation"];
      $email = $_POST["email"];
      //use prepare function
      $stmt = $db_obj->prepare($sql);
      $stmt->bind_param("ssssssi", $salutation, $email, $fname, $lname, $usertype, $activation, $userID );
      //executes the statement
      $stmt->execute();
      //close the statement
      $stmt->close();
      //close the connection
      $db_obj->close();
      header('Location: ?userID='. $userID);
      die();
    }
  }
  function test_input($data){
    $data = trim($data); //unnötige leerzeichen etc entfernen
    $data = stripslashes($data); //Backlashes entfernen vom unser input
    $data = htmlspecialchars($data); //zu htmlspecialchars machen (Security reasons)
    return $data;
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
     <h1 id = "heading-1">Update profile </h1>
  </div>
  <br>


  <div class=container>

    <div class="sickbg container jumbotron">
      <form name="kiki" action="#" method="post"> 
      
        <div class="form-group col-md-4">
          <label for="salutation">Salutation</label>
          <select autocomplete="off" id="salutation" name="salutation" class="form-control" value="<?php echo $salutation;?>">
            <!--shows actuall salutation, if there is one, if not - first option will be shown-->
            <option  <?php if ($salutation=="Mrs.") {echo "selected"; }?>>Mrs.</option>
            <option  <?php if ($salutation=="Ms.") {echo "selected"; }?>>Ms.</option>
            <option  <?php if ($salutation=="Mr.") {echo "selected"; }?>>Mr.</option>
            <option  <?php if ($salutation=="Dr.") {echo "selected"; }?>>Dr.</option>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label for="fname">First name:</label>
          <span class="error">* <?php echo $fnameErr;?></span>
          <input  class="form-control" name="fname" type="text" id="fname" placeholder="First name"  value="<?php echo $fname; ?>" required/>
      
          <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
        </div>

        <div class="form-group col-md-6">
          <label for="lname">Lastname:</label>
          <span class="error">* <?php echo $lnameErr;?></span>
          <input  class="form-control" name="lname" type="text" id="lname" placeholder="Last name" value="<?php echo $lname; ?>" required/>
          
          <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
        </div>

        <div class="form-group col-md-6">
          <label for="email">E-Mail-Address:</label>
          <span class="error">* <?php echo $emailErr;?></span>
          <input  class="form-control" name="email" type="email" id="email" placeholder="E-Mail-Adresse" value="<?php echo $email; ?>" required/>
      
          <input type="hidden" value= "<?php echo $userID ; ?>" name="userID"></input>
        </div> 
        <?php if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1):?> 
          <!--if userrole is Administrator it is possible to update role and activation status of user-->
          <div class="form-group col-md-3">
            <label for="userType">UserType</label>
            <select id="userType" name="userType" class="form-control">
              <option <?php if ($usertype==3) {echo "selected"; }?>>Normal User</option>
              <option <?php if ($usertype==2) {echo "selected"; }?>>Service Engineer</option>
              <option <?php if ($usertype==1) {echo "selected"; }?>>Admin</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="activation">Activation</label>
            <select id="activation" name="activation" class="form-control" value="<?php echo $activation;?>">
              <option <?php if ($activation=="Activated") {echo "selected"; }?>>Activated</option>
              <option <?php if ($activation=="Deactivated") {echo "selected"; }?>>Deactivated</option>
            </select>
          </div>
        <?php endif; ?> 

        <button type='submit' name='submit' class='btn btn-primary' value="id"> Update </button><br><br>
        <a class="btn btn-primary" href="changePw.php?userID= <?php echo $_GET["userID"]; ?>" >Change password</a>
      </form>
      <br>
      <?php if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1): ?>
      <a class="btn btn-info" href="user_table.php">Go back</a>
      <?php endif;?>
    </div> 
  </div>
</body>
<?php
    include 'webstructure/footer.php';
?>
