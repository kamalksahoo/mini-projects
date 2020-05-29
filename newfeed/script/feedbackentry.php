<?php

    include "../includes/session.php";
    include "../includes/connection.php";

    $subject = $_GET['subject'];

    $query = "SELECT topic,understood,notunderstood,partialunderstood,totalentry FROM feedbacklog WHERE subject ='$subject'";
    $result = mysqli_query($con,$query);
    while($data = mysqli_fetch_assoc($result)){
        $topic = $data['topic'];
        $u = $data['understood'];
        $nu = $data['notunderstood'];
        $pu = $data['partialunderstood'];
        $total = $data['totalentry'];

        if($_GET[$topic]== 'u'){
            $u +=1 ;
        }
        if($_GET[$topic]== 'nu'){
            $nu +=1 ;
        }
        if($_GET[$topic]== 'pu'){
            $pu +=1 ;
        }

        $total +=1;

        $qry = "UPDATE feedbacklog SET understood='$u',notunderstood='$nu',partialunderstood='$pu',totalentry='$total' WHERE topic='$topic' and subject='$subject';";
        $update = mysqli_query($con,$qry);
    }

    $sid = $_SESSION['student_id'];

    $qry = "INSERT INTO given_feedback VALUES ('$sid','$subject');";
    $insert = mysqli_query($con,$qry);
    

    header("location:../studentdash.php?Home=true");




/*
    if(isset($_SESSION['student_id']))
    {
        $feedback_id = $_POST['feedback_id'];
        $student_id = $_SESSION['student_id'];

        $query = "SELECT * FROM feedbacklog WHERE feedback_id='$feedback_id';";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);

        $understood = $data['understood'];
        $notunderstood = $data['notunderstood'];
        $partialunderstood = $data['partialunderstood'];
        $totalentry = $data['totalentry'];

        if($_POST['topic']=="understood")
        {
            $understood = $understood + 1;
            $totalentry = $totalentry + 1;
        }

        if($_POST['topic']=="notunderstood")
        {
            $notunderstood = $notunderstood + 1;
            $totalentry = $totalentry + 1;
        }
        
        if($_POST['topic']=="partialunderstood")
        {
            $partialunderstood = $partialunderstood + 1;
            $totalentry = $totalentry + 1;
        }
        //$query = "UPDATE feedbacklog SET understood='$understood' WHERE feedback_id='$feedback_id';";
        $query = "UPDATE feedbacklog SET understood='$understood',notunderstood='$notunderstood',partialunderstood='$partialunderstood',totalentry='$totalentry' WHERE feedback_id='$feedback_id';";
        $update = mysqli_query($con,$query);
        

        //updating available feeback table 
        $query = "INSERT INTO available_feedback VALUES ('$student_id','$feedback_id');";
        $done = mysqli_query($con,$query);;


        header("location:../studentdash.php?status=success");
    }
    
    */