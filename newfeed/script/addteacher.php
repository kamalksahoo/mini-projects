<?php

    include '../includes/connection.php';
 
    if(isset($_POST['submit']))
    {
        echo "hi";
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $branch = $_POST['branch'];
        $dob = $_POST['dob'];
        $password = rand(111111,999999);
        $query = "INSERT INTO teachers VALUES (NULL,'$fname','$lname','$email','$branch','$dob',$password);";
        $result = mysqli_query($con,$query);
        header("location:../admindash.php?success=true");
    }
    else
    {
        header("location:../index.php");
    }
