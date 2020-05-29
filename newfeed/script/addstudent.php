<?php
  include '../includes/connection.php';

  $rollnumber=$_POST['rollnumber'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $branch = $_POST['branch'];
  $year = $_POST['year'];
  $password = rand(111111,999999);
  if(isset($_POST['submit']))
  {
      $query = "INSERT INTO student VALUES ('$rollnumber','$fname','$lname','$branch','$year','$email','$password');";
      $result = mysqli_query($con,$query);
      header("location:../admindash.php?addstudentdata=success");

      mail($email,"Welcome! your account has been created","
    username is ".$email." 
    password is ".$password." 
    please change it as soon as possible 
    
    ");
  }
  else
  {
      header("location:../index.php");
  }

?>
