<?php
    include 'webstructure/head.php';

    $emailErr=$passwordErr=$salutationErr=$fnameErr=$lnameErr=$unameErr= "";

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


<div class="container">
    <?php
        if($err)
        echo '<div class="alert alert-danger alert-dismissible">Check your input please </div>';
    ?>
</div>

<div class="sickbg container jumbotron">
    
    <form name="myForm" action="index.php?site=update" method="post"> 
   
 
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
    <div class="form-group ">
        <label for="fname">First name:</label>
        <span class="error">* <?php echo $fnameErr;?></span>
        <input  class="form-control" name="fname" type="text" id="fname" placeholder="First name"  value="<?php echo $result['Fname']; ?>" required/>
    </div>

    <div class="form-group ">
        <label for="lname">Lastname:</label>
        <span class="error">* <?php echo $lnameErr;?></span>
        <input  class="form-control" name="lname" type="text" id="lname" placeholder="Last name" value="<?php echo $result['Lname']; ?>" required/>
    </div>

    <div class="form-group ">
        <label for="uname">Username:</label>
        <span class="error">* <?php echo $unameErr ;?></span>
        <input  class="form-control" name="uname" type="text" id="uname" placeholder="User name"  value="<?php echo $result['Uname']; ?>" required />
    </div> 

    <div class="form-group " >
        <label for="email">E-Mail-Address:</label>
        <span class="error">* <?php echo $emailErr;?></span>
        <input  class="form-control" name="email" type="email" id="email" placeholder="E-Mail-Adresse" value="<?php echo $result['Email']; ?>" required/>
    </div> 

    <button type='submit' name='submit' class='btn btn-primary' value="id"> Update </button>
    
    </form>
</div> 


</body>
<?php
    include 'webstructure/footer.php';
?>
