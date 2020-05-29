<?php
    include "includes/session.php";

    if(!isset($_GET['loginerror'])){
        if(!isset($_GET['person'])){
            header('location:index.html');
        }
        else{
            $_SESSION['person'] = $_GET["person"];
        }
    }   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - feedback system</title>
    <link rel="stylesheet" href="css/index1.css">
    
</head>
<body>
    <h1>Student-Teacher</h1>
    <form action="script/check.php" method="POST">
        <div class="card">
            <div class="login">
               <input type="text" name="username" class="input" required placeholder="username"><br>
               <input type="password" name="password" class="input" required placeholder="password"><br>
                <?php 
                    if(isset($_GET['loginerror'])){
                        echo ' 
                        <p style="color:red">Incorrect details entered! Please try again</p>
                        ';
                    }
                ?>
                <?php

                ?>
                
                <input type="submit" value="LOGIN" name="submit" class="input btn"><br>
                <a href="" class="link">forgot password</a>
            </div>
        </div>
    </form> 

</body>
</html>