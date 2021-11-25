<?php
    // beim ersten laden der seite gibt es noch keinen input, deshalb hier als leer deklarieren, damit uns kein fehlercode ausgegeben wird
   if (!isset($firstname)) {
    $firstname = "";
  }
  
  if (!isset($email)) {
    $email = "";
  }

  if (!isset($password)) {
    $password = "";
  }
    
  if (!isset($lastname)) {
    $lastname = '';
  }

  if (!isset($adress)) {
    $adress = "";
  }
  
  if (!isset($adress2)) {
    $adress2 = "";
  }

  if (!isset($gender)) {
    $gender = "";
  }

  if (!isset($zip)) {
    $zip = "";
  }

  if (!isset($city)) {
    $city = "";
  }

  if (!isset($state)) {
    $state = "";
  }
  $firstnameErr = $lastnameErr = $emailErr = $genderErr = $passwordErr = $lastnameErr = $adressErr= $adressErr2 = $cityErr = $zipErr = $stateErr= "";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration form</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .error {color: #FF0000;}
    </style>

</head>
  <body>
    <!--Navbar-->

    
      <?php
        include 'nav.php';
      ?>

        <br>
        <!-- Gäste-Registrierung für das Semesterprojekt. Dieses Formular beinhaltet folgende Felder: 
        E-Mail-Adresse, Anrede (select), Vorname, Nachname, Postleitzahl, Ort, Straße, Hausnummer-->
            <!--form action="results.html" method="GET"-->
        <br>
  <div class="container">
    <div class="row">
      <h1 class="page-header text-center">User registration</h1>
      <br/><br/>
      <h3 class="page-header text-center">Please fill in your information:</h3><br/>
        
        <br/><br/>

        <form class="ms-5 me-5 ps-5 pe-5" method="post" action="validation.php"> <!--Meldungen "is required" werden nicht angezeigt...-->
        


        
<!--hier verstehe ich nicht, warum Placeholder ist anders und hintergrund ist gelb/gleich bei password-->

        <label for="email" class="form-label">E-Mail </label>
                <input class="form-control" 
                type="email" 
                id="email" 
                name="email" 
                placeholder="johndoe@i.ua"  
                value="<?php echo htmlspecialchars($email)?>"> <!--pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"-->
                <?php if(isset($emailErr)){ ?>
                    <p class="text-danger"><?php echo $emailErr; ?></p>
                <?php } ?>
           
            
               <label for="password">Password</label>
               <input 
               type="password" 
               class="form-control"
               id="password" 
               placeholder="Password"
               value="<?php echo htmlspecialchars($password)?>">
                                <?php if(isset($passwordErr)){ ?>
                    <p class="text-danger"><?php echo $passwordErr; ?></p>
                <?php } ?>
         
                    <label for="gender">Gender</label>
                    <span class="error">* <?php echo $genderErr;?></span>
                    <select id="gender" 
                            class="form-control"
                            value ="<?php echo htmlspecialchars($gender)?>">
                                <?php if(isset($genderErr)){ ?>
                    <p class="text-danger"><?php echo $genderErr; ?></p>
               
                    <?php } ?>
                      <option selected>Choose...</option>
                      <option>Female</option>
                      <option>Male</option>
                      <option>Non-binary</option>
                    </select>
             
                    <label for="fistname">First Name</label>
                    <span class="error">* <?php echo $firstnameErr;?></span>
                    <input  
                            type="text" 
                            class="form-control" 
                            id="firstname" 
                            name="firstname"
                            placeholder="John"
                            value="<?php echo htmlspecialchars($firstname)?>">
               
                <?php if(isset($firstnameErr)){ ?>
                    <p class="text-danger"><?php echo $firstnameErr; ?></p>
                <?php } ?>
              
                    <label for="lastname">Last Name</label>
                    <span class="error">* <?php echo $lastnameErr;?></span>
                    <input  
                            type="text" 
                            class="form-control"
                            id="lastname" 
                            placeholder="Doe"
                            value="<?php echo htmlspecialchars($lastname)?>">
                                <?php if(isset($lastnameErr)){ ?>
                    <p class="text-danger"><?php echo $lastnameErr; ?></p>
                <?php } ?>
                 
              
                  <label for="adress">Address</label>
                  <span class="error">* <?php echo $adressErr;?></span>
                  <input 
                      type="text" 
                      class="form-control"  
                      id="address" 
                      placeholder="1234 Main St"
                      value ="<?php echo htmlspecialchars($adress)?>">
                                <?php if(isset($adressErr)){ ?>
                    <p class="text-danger"><?php echo $adressErr; ?></p>
                <?php } ?>
                      
                  <label for="address2">Address details</label>
                  <span class="error">* <?php echo $adressErr2;?></span>
                  <input 
                      type="text" 
                      class="form-control"
                      id="address2" 
                      placeholder="Apartment, studio"
                      value="<?php echo htmlspecialchars($adress2)?>">
                                <?php if(isset($adressErr2)){ ?>
                    <p class="text-danger"><?php echo $adressErr2; ?></p>
                <?php } ?>
              
                      <label for="state">State</label>
                      <select id="state" class="form-control">
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
                  
                  <div class="row">
                    <div class="col-8">
                    
                    <label for="city">City</label>
                    <span class="error">* <?php echo $cityErr;?></span>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="city"
                      placeholder="Vienna">
                   </div>

                    <div class="col-4">
                    <label for="zip" class="form-label">Zip Code </label>
                <input 
                class="form-control" 
                id="zip" 
                name="zip" 
                type="text" 
                maxlength="4" 
                value="<?php echo htmlspecialchars($zip)?>">
                <?php if(isset($zip_err)){ ?>
                    <p class="text-danger"><?php echo $zip_err; ?></p>
                <?php } ?>

                    </div>
                </div>
                               
                <br>
                  
                 
                  <div class="form-group col-md-2">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
             </div>
      </form> 
    </div>
  </body>
</html>