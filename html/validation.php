<?php

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $adress = $_POST['adress'];
  $adress2 = $_POST['adress2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $gender = $_POST['gender'];
  $password = $_POST['password'];

  if(empty($firstname)){
    $firstnameErr = "<p class = 'text-danger'>First name is required</p>";
  }
  if(empty($lastname)){
    $lastnameErr = "<p class='text-danger'>Last name is required</p>";
  }
  if(empty($email)){
    $emailErr = "<p class='text-danger'>Email is required</p>";
  }
  if (empty($password)) {
    $passwordErr = "<p class='text-danger'>Password is required</p>";
  }
  if(empty($adress)){
    $adressErr = "<p class='text-danger'>Adress is required</p>";
  }
  if(empty($adress2)){
    $adress2Err = "<p class='text-danger'>Adress details are required</p>";
  }
  if(empty($city)){
    $cityErr = "<p class='text-danger'>City is required</p>";
  }
  
  if(empty($gender)){
      $genderErr = "<p class='text-danger'>Gender is required</p>";
  }
  if(empty($state)){
      $stateErr = "<p class ='text-danger'>Please choose your state</p>";
  }
  if(empty($zip)){
    $zipErr = "<p class='text-danger'>ZIP is required</p>";
  }
   
  include('registration_form.php'); //um beim laden der validation seite, wieder das formular anzuzeigen anstatt einer leeren seite

?>
