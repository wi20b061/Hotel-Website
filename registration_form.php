<?php
  session_start();

  $email=$password=$salutation=$gender=$fname=$lname=$uname=$rememberMe = "";
  $emailErr=$passwordErr=$genderErr=$fnameErr=$lnameErr=$unameErr=$rememberMeErr = "";

  //salutation - fname - lname - email - uname - pw
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(!empty($_POST["salutation"])){
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

    if(empty($_POST["email"])){
      $emailErr = "Email is required";
    }else{
      $email = test_input($_POST["email"]);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
          $emailErr = "Invalid email format";
      }
    }

    if(empty($_POST["uname"])){
      $lnameErr = "User name is required";
    }else{
      $uname = test_input($_POST["uname"]);
      if(!preg_match("/^[a-zA-Z-' ]*$/",$uname)){ 
        $unameErr = "Only letters and whitespace allowed";
      }
    }

    if(empty($_POST["password"])){
      $passwordErr = "Password is required";
    }else{
      $password = test_input($_POST["password"]);
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

    <br>
    <!--salutation - fname - lname - email - uname - pw-->
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
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" value="<?php echo $email;?>">
          </div>
        </div>
        <div class="form-group">
          <div class="form-group col-md-6">
            <label for="uname">Username</label>
            <span class="error">* <?php echo $unameErr;?></span>
            <input type="text" class="form-control" name="uname" id="uname" placeholder="example32" value="<?php echo $uname;?>">
          </div>
          <div class="form-group col-md-6">
            <label for="Password">Password</label>
            <span class="error">* <?php echo $passwordErr;?></span>
            <input type="password" name="password" class="form-control" id="password" value="<?php echo $password;?>">
          </div>
          <div class="form-group col-md-2">
            <div class="form-check ">
              <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" value="<?php
              if(isset($rememberMe) && $rememberMe=="true"){ echo "checked";} ?>">
              <label class="form-check-label" for="rememberMe">
                Remember me
              </label>
            </div>
          </div>
          <div class="form-group col-md-5">
              <button type="submit" class="btn-space btn btn-primary">Submit</button>
              <button type="reset" class="btn-space  btn btn-primary">Reset</button><!--brauchen wir das?? Funktioniert nicht!-->
          </div>
        </div>
      </form>
    </div>


<?php
  include 'webstructure/footer.php';
?>