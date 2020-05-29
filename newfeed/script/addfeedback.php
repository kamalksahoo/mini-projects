<?php
    include '../includes/connection.php';
    include '../includes/session.php';

    $subject =  $_SESSION['subject'];

    $teacher_id=$_SESSION['teacher_id'];
    $branch = $_SESSION['branch'];

    $query = "SELECT year FROM subjects WHERE subject='$subject'";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_assoc($result);
    $year = $data['year'];
    echo $year; 

    foreach($_GET['feedback'] as $topic){
        $topic = str_replace(" ","_",$topic);
        $query = "INSERT INTO feedbacklog VALUES ('NULL','$teacher_id','$branch','$year','$subject','$topic',0,0,0,0);";
        $result = mysqli_query($con,$query);
    }

    $query = "INSERT INTO feedback_generated VALUES ('$year','$subject')";
    $result = mysqli_query($con,$query);
    
    
    header("location:../teacherdash.php?success=true");
    
    
    