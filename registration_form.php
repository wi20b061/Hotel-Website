<?php

$email=$password=$salutation=$gender=$fname=$lname=$username=$address=$city=$state=$zip=$rememberMe = "";
$emailErr=$passwordErr=$salutationErr=$genderErr=$fnameErr=$lnameErr=$unameErr=$addressErr=$cityErr=$stateErr=$zipErr=$rememberMeErr = "";

session_start();
  
  include 'webstructure/head.php';

require_once ('dbaccess.php');

$db_obj = new mysqli($host, $user, $password, $database);
if ($db_obj->connect_error) {
    echo "Collection failed!";
    exit();

}

if($_SERVER["REQUEST_METHOD"] == "POST"){

 # {
 #   if(isset($_POST["username"]) && !empty($_POST["username"])
 #   && isset($_POST["salutation"]) && !empty($_POST["salutation"])
 #   && isset($_POST["fname"]) && !empty($_POST["fname"])
 #   && isset($_POST["lname"]) && !empty($_POST["lname"])
 #       && isset($_POST["password"]) && !empty($_POST["password"])
 #       && isset($_POST["email"]) && !empty($_POST["email"])) 
    
      //validation
    
        if(empty($_POST["email"])){
          $emailErr = "Email is required";
        }else{
          $email = test_input($_POST["email"]);
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
              $emailErr = "Invalid email format";
          }
        }
        if(empty($_POST["password"])){
          $passwordErr = "Password is required. Minimum four letters = 1 character and 1 numerical value";
        }else{
          $password = test_input($_POST["password"]);
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
        if(empty($_POST["username"])){
            $lnameErr = "User name is required";
          }else{
            $username = test_input($_POST["username"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/",$username)){ 
              $unameErr = "Only letters and whitespace allowed";
          }
          }
             
        //verify the new password
        if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d\w\W]{4,}$/",$_POST["password"])) {
          $passwordErr="Password is required. <br>
            Minimum four letters = 1 character and 1 numerical value";
        }else{ 
          $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT); 
        }
            

    $db_obj = new mysqli($host, $user, $password, $database);

    //question marks (?) are parameters used for later variables bindings. $sql is like a template
    $sql = "INSERT INTO `user` (`salutation`,`username`, `password`, `email`, `lname`,`fname` ) VALUES (?, ?, ?, ?, ?, ?)";

    //use prepare function
    $stmt = $db_obj->prepare($sql);

    
    //followed by the variables which will be bound to the parameters
    $stmt-> bind_param("ssssss", $salutation, $username, $password, $email, $lname, $fname, );

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $salutation = $_POST["salutation"];

     //executes the statement
        $stmt->execute();
    
    //, if successful --> echo
    #if ($stmt->execute()) {
    #    echo "New user created";
        //trigger forwarding to welcome-page, get-started tutorial,
        //confimation email with username (but without chosen password!), etc.
   # }
    #else {
    #    echo "Error";
        //or specific error-page
   # }

    //close the statement
    $stmt->close();
    //close the connection
    $db_obj->close();
   # header('Refresh: 1; URL =register.php');

    #}
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
                    <option selected>Choose...</option>
                    <option>Mrs.</option>
                    <option>Mr.</option>
                    <option>Ms.</option>
                    <option>Dr.</option>
                  </select>
              </div>


            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <span class="error">* <?php echo $emailErr;?></span>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="<?php echo $email;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <span class="error">* <?php echo $passwordErr;?></span>
                <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" value="<?php echo $password;?>">
            </div>
        </div>
        <div class="form-group">
                
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
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Didi" value="<?php echo $username;?>">
          </div>
          
          <div class="form-group col-md-2">
            <div class="form-check ">
              <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" <?php
              if(isset($rememberMe) && $rememberMe=="true") echo "checked" ?>>
              <label class="form-check-label" for="rememberMe">
                Remember me
              </label>
            </div>
          </div>
          <div class="form-group col-md-2">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-primary">Reset</button>
          </div>
      </form>
  </div>
    </div>

<?php
  include 'webstructure/footer.php';
?>
