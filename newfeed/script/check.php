<?php
    include '../includes/connection.php';
    include '../includes/session.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $person=$_SESSION["person"];

    if($person == "admin")
    {
        $query = "SELECT * FROM adminlogin WHERE username='$username' and password='$password';";
        $result = mysqli_query($con,$query);
        $row = mysqli_num_rows($result);
        
        if($row==1)
        {
            $_SESSION['person'] = "admin";
            header("location:../admindash.php");
        }
        else
        {
            header("location:../index.php?loginerror=true");

        }
    }
    else if($person == "teacher" )
    {
        
        $query = "SELECT * FROM teachers WHERE email='$username' and password='$password';";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        if($row == 1)
        {
            $_SESSION['person'] = "teacher";
            $_SESSION['teacher_id']=$data['teacher_id'];
            $_SESSION['firstname']=$data['firstname'];
            $_SESSION['lastname']=$data['lastname'];
            $_SESSION['email']=$data['email'];
            $_SESSION['branch']=$data['branch'];
            $_SESSION['dob']=$data['dob'];

            $tid = $_SESSION['teacher_id'];

            $query = "SELECT subject_id FROM teacher_subject WHERE teacher_id = '$tid';";
            $result = mysqli_query($con,$query);

            $subjectidlist= array();
            
            while($data = mysqli_fetch_assoc($result)){

                array_push($subjectidlist,$data['subject_id']);
            }

            $_SESSION['subjectidlist'] = $subjectidlist;

            foreach($subjectidlist as $x){
                $query = "SELECT subject FROM subjects WHERE subject_id = '$x';";
                $result = mysqli_query($con,$query);
                $data = mysqli_fetch_assoc($result);    
                $subjectnamelist[$x]=$data['subject'];
            }

            $_SESSION['subjectnamelist']=$subjectnamelist;

            header("location:../teacherdash.php");
        }
        else
        {
            header("location:logout.php");
        }
    }
    else
    {
        
        $query = "SELECT * FROM student WHERE email='$username' and password='$password';";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        if($row == 1)
        {
            
            $_SESSION['person'] = "student";
            $_SESSION['student_id']=$data['rollnumber'];
            $_SESSION['branch']=$data['branch'];
            $_SESSION['year']=$data['year'];
            $_SESSION['firstname']=$data['firstname'];
            $_SESSION['lastname']=$data['lastname'];
            $_SESSION['email']=$data['email'];



            header("location:../studentdash.php");
        }
        else
        {
            header("location:../index.php?loginerror=true");
        }
    }
