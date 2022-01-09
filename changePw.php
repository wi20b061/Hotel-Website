<?php
    include 'webstructure/head.php';
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

 <?php
    //change button is selected
    if (isset($_POST["change"])){
        //old password
        if ($_POST["passwordAlt"] !== -1 && password_verify($_POST["passwordAlt"], $_SESSION['password'] )) {
            
            //verify the new password
            if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,}$/",$_POST["passwordNeu"])) {
                echo '<div class="alert alert-danger alert-dismissible">Minimum eight letters = 1 character and 1 numerical value</div>';
                $err=true;
            } else {
                //password confirmation
                if ($_POST["passwordNeu"] != $_POST["passwordNeuB"] ) {
                    echo '<div class="alert alert-danger alert-dismissible">The password is not the same!</div>';
                } else{
                    // the password is protected in form of hash output
                    $hash = password_hash($_POST["passwordNeu"], PASSWORD_BCRYPT);
                    //the password is passed along into the databank, with the corresponding username
                    $db->updatePassword($_SESSION['username'],$hash);
                    $_SESSION['password'] = $hash;

                    //corresponding header is outputted 
                    header('Location: index.php?site=profil&change=true');
                }
            } 

        } else {
            //if the password is incorrect 
            $err=true;
            echo $_SESSION['password'].'<div class="alert alert-danger alert-dismissible">Incorrect Password!</div>';

        }
       
    } 
       //change button is selected
       if (isset($_POST["change"])){
                                          
           //the first name is passed along into the databank, with the corresponding username
                $db->updateFname($_SESSION['username']);
                    
                //corresponding header is outputted 
                header('Location: index.php?site=profil&change=true');
                } 
        
     

         //change button is selected
         if (isset($_POST["change"])){
         
              //the last name is passed along into the databank, with the corresponding username
                $db->updateLname($_SESSION['username']);
                        
              //corresponding header is outputted 
                header('Location: index.php?site=profil&change=true');
                   
            } 
?>

<h3 class="text-center">Changing Your Password</h3>
<div class="sickbg container jumbotron">
        <form class="px-4 py-3" method="post" action="index.php?site=password" >
            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="passwordAlt"  class="form-control" id="password1" placeholder="Your Password">
            </div>
            <div class="form-group">
                <label for="password2">New Password</label>
                <input type="password" name="passwordNeu"  class="form-control" id="password2" placeholder="Your new password">
            </div>
            <div class="form-group">
                <label for="password3">Retype New Password</label>
                <input type="password" name="passwordNeuB"  class="form-control" id="password3" placeholder="Type in new password again">
            </div>
            <button type="submit" name="change" class="btn btn-primary">Apply Password Changes</button>

        </form>
</div>

<h3 class="text-center">Changing Your Name</h3>
<div class="sickbg container jumbotron">
        <form class="px-4 py-3" method="post" action="index.php?site=fname" >
          
            <div class="form-group">
                <label for="fname2">New First Name</label>
                <input type="fname" name="fnameNew"  class="form-control" id="fname2" placeholder="Your new First Name">
            </div>
           
            <button type="submit" name="change" class="btn btn-primary">Apply First name changes</button>

        </form>

        <form class="px-4 py-3" method="post" action="index.php?site=lname" >
           
            <div class="form-group">
                <label for="lname2">New Last Name</label>
                <input type="lname" name="lnameNew"  class="form-control" id="lname2" placeholder="Your new Last Name">
            </div>
           
            <button type="submit" name="change" class="btn btn-primary">Apply Last name changes</button>

        </form>

       </div>



</body>
<?php
    include 'webstructure/footer.php';
?>




