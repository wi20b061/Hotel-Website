<?php
  session_start();

  $email=$password=$salutation=$gender=$fname=$lname=$uname=$address=$city=$state=$zip=$rememberMe = "";
  $emailErr=$passwordErr=$salutationErr=$genderErr=$fnameErr=$lnameErr=$unameErr=$addressErr=$cityErr=$stateErr=$zipErr=$rememberMeErr = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["email"])){
      $emailErr = "Email is required";
    }else{
      $email = test_input($_POST["email"]);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
          $emailErr = "Invalid email format";
      }
    }
    if(empty($_POST["password"])){
      $passwordErr = "Password is required";
    }else{
      $password = test_input($_POST["password"]);
    }
    if(empty($_POST["salutation"])){
        $salutationErr = "Salutaton is required";
      }else{
        $salutation = test_input($_POST["salutation"]);
      }
    if(empty($_POST["gender"])){
      $genderErr = "Gender is required";
    }else{
      $gender = test_input($_POST["gender"]);
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
    if(empty($_POST["uname"])){
        $lnameErr = "User name is required";
      }else{
        $uname = test_input($_POST["lname"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$uname)){ 
          $unameErr = "Only letters and whitespace allowed";
      }
      }
    if(empty($_POST["address"])){
      $addressErr = "";
    }else{
      $address = test_input($_POST["address"]);
    }
    if(empty($_POST["city"])){
      $cityErr = "";
    }else{
      $city = test_input($_POST["city"]);
    }
    if(empty($_POST["state"])){
      $stateErr = "";
    }else{
      $state = test_input($_POST["state"]);
    }
    if(empty($_POST["zip"])){
      $zipErr = "";
    }else{
      $zip = test_input($_POST["zip"]);
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
    <title>Registration</title>
  </head>
  <body>
    <?php
      include 'webstructure/nav.php';
    ?>
    <br>

    <!-- Gäste-Registrierung für das Semesterprojekt. Dieses Formular beinhaltet folgende Felder: 
    E-Mail-Adresse, Anrede (select), Vorname, Nachname, Postleitzahl, Ort, Straße, Hausnummer-->
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
                  <span class="error">* <?php echo $salutationErr;?></span>
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
                <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" value="<?php echo $email;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <span class="error">* <?php echo $passwordErr;?></span>
                <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" value="<?php echo $password;?>">
            </div>
        </div>
        <div class="form-group">
              <div class="form-group col-md-4">
                  <label for="gender">Gender</label>
                  <span class="error">* <?php echo $genderErr;?></span>
                  <select id="gender" name="gender" class="form-control" value="<?php echo $gender;?>">
                    <option selected>Choose...</option>
                    <option>Female</option>
                    <option>Male</option>
                    <option>Non-binary</option>
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
          </div>
          <div class="form-group col-md-6">
            <label for="uname">Username</label>
            <input type="text" class="form-control" name="uname" id="uname" placeholder="Didi" value="<?php echo $uname;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="<?php echo $address;?>">
          </div>
          <div class="form-group col-md-6">
              <label for="city">City</label>
              <input type="text" class="form-control" name="city" id="city" value="<?php echo $city;?>">
          </div>
          <div class="form-group col-md-4">
              <label for="state">State</label>
              <select id="state" name="state" class="form-control" value="<?php echo $state;?>">
                <option selected>Choose...</option>
                <option>Germany</option>
                <option>Sweden</option>
                <option>Monaco</option>
                <option>Norway</option>
                <option>Denmark</option>
                <option>Finland</option>
                <option>Ukraine</option>
                <option>Luxemburg</option>
                <option>Niederland</option>
                <option>Czech Republic</option>
                <option>Portugal</option>
                <option>Switzerland</option>
                <option>Poland</option>
                <option>Spain</option>
                <option>France</option>
                <option>Italy</option>
                <option>Great Britain</option>
                <option>USA</option>
                <option>Australia</option>
                <option>Canada</option>
                <option>Russia</option>
                <option>Belarus</option>
                <option>China</option>
                <option>India</option>
              </select>
          </div>
          <div class="form-group col-md-2">
              <label for="zip">Zip</label>
              <input type="text" name="zip" class="form-control" id="zip" value="<?php echo $zip;?>">
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
