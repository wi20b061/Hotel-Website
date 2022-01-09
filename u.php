<?php
    include 'webstructure/head.php';
?>


    <?php
       if(isset($_GET['update']))
       echo '<div class="alert alert-success alert-dismissible">User edited!</div>';
       if(isset($_GET['change']))
       echo '<div class="alert alert-success alert-dismissible">Password has been changed!</div>';
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

    <h3>Your Personal Data</h3>
    <form action="index.php?site=update" method="post">
  
    <?php ##  $result = $db->getUser($_SESSION['uname']); 
  ##  $id = $result['id'];?>


        <table class="table table-borderless">
            <tr>
            <th scope="row">Salutation:</th>
            <td> <?php echo $result['Salutation']; ?></td>
            </tr>
            <tr>
            <th scope="row">Firstname:</th>
            <td><?php echo $result['Fname']; ?></td>
            </tr>
            <tr>
            <th scope="row">Lastname:</th>
            <td><?php echo $result['Lname']; ?></td>
            </tr>
            <tr>
            <th scope="row">Username:</th>
            <td><?php echo $result['Uname']; ?></td>
            </tr>
            <tr>
            <th scope="row">Email:</th>
            <td><?php echo $result['Email']; ?></td>
            </tr>
        </table>
        </form>
    <form action="editData.php" method="POST">
        <button class="btn btn-success " type="submit" name="update" value='$id' style="padding-left: 5px;margin-top: 10px;">Edit User Profile</button>
        
    </form>
    <form action="changePw.php" method="POST">
        <button class="btn btn-info " type="submit" name="changeP" style="padding-left: 5px;margin-top: 10px;">Change your Password</button>
        
    </form>
</div>


<?php

$fnameErr = $lnameErr = $unameErr = $passwortErr = $passwortBErr = $emailErr = "";
$err=false;


##$result = $db->getUser($_SESSION['uname']); 
##$id = $result['id'];

if (isset($_POST["submit"])){
  
    $anrede=$_POST["Salutation"];

    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["fname"])  or preg_match("/^\s*$/",$_POST['fname'])) {
        $fnameErr = "Only letters and white space allowed";
        $err=true;
      } else {
        $fname = test_input($_POST["fname"]);
    }
    
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lname"])  or preg_match("/^\s*$/",$_POST['lname'])) {
        $lnameErr = "Only letters and white space allowed";
        $err=true;
      } else {
        $lname = test_input($_POST["lname"]);
    }

    
    if (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/",$_POST["uname"])) {
        $unameErr = "invalid username";
        $err=true;
    } else if ($db->getUser($_POST["uname"]) != -1){

        if($_POST["uname"] == $_SESSION['uname'])
            $uname = test_input($_POST["uname"]);
        else {
            $unameErr = 'username already exists';
            $err=true;
        }

    } else 
        $uname = test_input($_POST["uname"]);
    
   
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $err=true;
    } else {
        $email = test_input($_POST["email"]);
    }

}


function test_input($data) {
    $data = trim($data);
    return $data;
  }
?>


</body>
<?php
    include 'webstructure/footer.php';
?>

