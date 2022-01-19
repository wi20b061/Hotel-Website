<?php
  $email=$password=$salutation=$fname=$lname=$username=$usertype=$exists = "";
  $emailErr=$passwordErr=$fnameErr=$lnameErr=$unameErr = "";

  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }

  include 'webstructure/head.php';

  require_once ('dbaccess.php');

  $db_obj = new mysqli($host, $user, $password, $database);
  if ($db_obj->connect_error) {
      echo "Collection failed!";
      exit();
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){ 
      //validation
      $salutation = test_input($_POST["salutation"]);
      $usertype = test_input($_POST["userType"]);

      if(empty($_POST["email"])){
        $emailErr = "Email is required";
      }else{
        $email = test_input($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $emailErr = "Invalid email format";
        }else{
          $emailErr="";
        }
      }
            
      if(empty($_POST["fname"])){
        $fnameErr = "First name is required";
      }else{
        $fname = test_input($_POST["fname"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$fname)){ 
          $fnameErr = "Only letters and whitespace allowed";
        }else{
          $fnameErr="";
        }
      }

      if(empty($_POST["lname"])){
        $lnameErr = "Last name is required";
      }else{
        $lname = test_input($_POST["lname"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$lname)){ 
          $lnameErr = "Only letters and whitespace allowed";
        }else{
          $lnameErr="";
        }
      }

      if(empty($_POST["username"])){
          $unameErr = "User name is required";
      }else{
        $username = test_input($_POST["username"]);
        if(!preg_match("/^[a-zA-Z0-9']*$/",$username)){ 
          $unameErr = "Only letters and numbers are allowed";
        }else{
          $unameErr="";
        }
      }

      if(empty($_POST["password"])){ //|| !preg_match("/^(?=.?[A-Z])(?=.?[a-z])(?=.?[0-9])(?=.?[#?!@$%^&*-]).{8,}$/",$_POST["password"])) {
        $passwordErr="Password is required.";
      }else{ 
        $password = htmlspecialchars($_POST["password"]);
        $password = password_hash($password, PASSWORD_DEFAULT); 
        $passwordErr="";
      }
      
      //testen ob username schon in der DB vorhanden ist
      $sql = "SELECT `username` FROM `user` WHERE  `username` = ?";

      $stmt = $db_obj->prepare($sql);
      $stmt-> bind_param("s", $username);
      $stmt->execute();
        
      //exists beinhaltet usernamen die mit dem ausgewählten schon übereinstimmen, 
      //ist es leer, ist der username noch nicht verwendet
      $stmt ->bind_result($exists);
      $stmt->fetch();

      //close the statement
      $stmt->close();

      if(!empty($exists)){
        $unameErr = "This username already exists!";
      }
      $usertype = 3;
      if(isset($_SESSION["userID"]) && $_SESSION["userID"] == 1){
        if($_POST["userType"] == "Normal User"){
          $usertype = 3;
        }else{
          $usertype = 2;
        }
      }

      /*if(!empty($email) && !empty($fname)
        && !empty($lname) && !empty($password)
        && !empty($username) && empty($exists)){*/
      if(empty($exists) && $emailErr== "" && $passwordErr=="" &&
      $fnameErr=="" && $lnameErr=="" && $unameErr==""){
          
        //Einlesen in die DB
        //question marks (?) are parameters used for later variables bindings. $sql is like a template
        $sql = "INSERT INTO `user` (`salutation`,`username`, `password`, `email`, `lname`,`fname`, `roleID`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        //use prepare function
        $stmt = $db_obj->prepare($sql);

        //followed by the variables which will be bound to the parameters
        $stmt-> bind_param("ssssssi", $salutation, $username, $password, $email, $lname, $fname, $usertype);

        $salutation = $_POST["salutation"];
        //executes the statement
        if($stmt->execute()){
          //Sollte hier ein Admin arbeiten, andere Paramter anzeigen
          if($_SESSION["userrole"] == 1 && $usertype == 2){
            header("Location: register_success.php?user=service&admin=t");
          }else if($_SESSION["userrole"] == 1 && $usertype == 3){
            header("Location: register_success.php?user=guest&admin=t");
          }else{
            header("Location: register_success.php?user=guest&admin=f");
          }
        }
        //close the statement
        $stmt->close();
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
?>

    <title>Registration</title>
  </head>
  <body>
    <?php
      include 'webstructure/nav.php';
    ?>
    <br>
    <!-- Gäste-Registrierung für das Semesterprojekt. Dieses Formular beinhaltet folgende Felder: 
    E-Mail-Adresse, Anrede (select), Vorname, Nachname, Password, Username-->
    <!--form action="results.html" method="GET"-->
    <br>
    <h1 class="page-header text-center">User registration</h1><br/>
    <div class="container">
      <div class="space">
          <span class="error">* required field</span>
      </div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <div class="form-group col-md-4">
            <label for="salutation">Salutation</label>
            <select id="salutation" name="salutation" class="form-control" value="<?php echo $salutation;?>">
              <option  <?php if ($salutation=="Mrs.") {echo "selected"; }?>>Mrs.</option>
              <option  <?php if ($salutation=="Ms.") {echo "selected"; }?>>Ms.</option>
              <option  <?php if ($salutation=="Mr.") {echo "selected"; }?>>Mr.</option>
              <option  <?php if ($salutation=="Dr.") {echo "selected"; }?>>Dr.</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="fname">First Name</label>
            <span class="error">* <?php echo $fnameErr;?></span>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="John" value="<?php echo $fname;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="lname">Last Name</label>
            <span class="error">* <?php echo $lnameErr;?></span>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Doe" value="<?php echo $lname;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?php echo $email;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <span class="error">* <?php echo $unameErr;?></span>
            <input type="text" class="form-control" name="username" id="username" placeholder="example32" value="<?php echo $username;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <span class="error">* <?php echo $passwordErr;?></span>
            <input type="password" name="password" class="form-control" id="inputPassword4">
          </div>
        </div>
        <!--Ist ein Admin angemelet, ist die Auswahl sichtbar-->
        <?php if(isset($_SESSION["userrole"]) && $_SESSION["userrole"] == 1):?>
          <div class="form-group col-md-4">
            <label for="userType">UserType</label>
            <select id="userType" name="userType" class="form-control" value="<?php echo $usertype;?>">
              <option <?php if ($usertype=="Normal User") {echo "selected"; }?>>Normal User</option>
              <option <?php if ($usertype=="Service Engineer") {echo "selected"; }?>>Service Engineer</option>
            </select>
          </div>
        <?php endif; ?>
        <div class="form-group">
          <div class="form-group col-md-2">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </form>
    </div>
<?php
  include 'webstructure/footer.php';
?>
