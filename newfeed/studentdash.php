<?php
    include "includes/session.php";
    include "includes/connection.php";
    
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student dashboard</title>
        <link rel="stylesheet" href="css/student.php">
    </head>
    <body>
        <div>
            <div class="left-bar">
                <h2 id="head">Student dashboard</h1>
                <a href="studentdash.php?studentprofile=true" class="options">Student Profile</a>
                <a href="studentdash.php?Home=true" class="options">Home</a>
                <a href="studentdash.php?Notice=true" class="options">Notice</a>
                <a href="script/logout.php" class="options">Logout</a>
            </div>
            <div class="main">
                
                <?php 
                    //student profile
                    echo "<h2 id='main-head'>".$_SESSION['firstname']." ".$_SESSION['lastname']."</h2>";
                    if(isset($_GET['studentprofile'])){
                        
                        $year = $_SESSION['year'];
                        if($year==1){
                            $y='first';
                        }else if($year==2){
                            $y='second';
                        }else if($year==3){
                            $y='third';
                        }else if($year==4){
                            $y='fourth';
                        }

                        
                        echo "
                            <div id='imgg'>
                                <img src='asset/studentlogo.png' alt='logo' id='img'>
                            </div>
                            <table id='tbl'>
                                <tr>
                                    <td class='td'>Roll Number</td>
                                    <td class='td'>".$_SESSION['student_id']."</td>
                                </tr>
                                <tr>
                                    <td class='td'>First name</td>
                                    <td class='td'>".$_SESSION['firstname']."</td>
                                </tr>
                                <tr>
                                    <td class='td'>Lastname</td>
                                    <td class='td'>".$_SESSION['lastname']."</td>
                                </tr>
                                <tr>
                                    <td class='td'>Email Id</td>
                                    <td class='td'>".$_SESSION['email']."</td>
                                </tr>
                                <tr>
                                    <td class='td'>Branch</td>
                                    <td class='td'>".$_SESSION['branch']."</td>
                                </tr>
                                <tr>
                                    <td class='td'>Year</td>
                                    <td class='td'>".$y."</td>
                                </tr>
                            </table>
                        ";
                    }

                    //feedback section
                    if(isset($_GET['Home'])){
                        echo "<h1 class='align'>feedback</h1>";
                        $year = $_SESSION['year'];
                        $query = "SELECT subject FROM feedback_generated WHERE year='$year'";
                        $result = mysqli_query($con,$query);
                        while($data = mysqli_fetch_assoc($result)){
                            $subject = $data['subject'];

                            $student_id = $_SESSION['student_id'];
                            $qry = "SELECT * FROM given_feedback WHERE student_id='$student_id' and subject='$subject'";
                            $chk =  mysqli_query($con,$qry);
                            $row = mysqli_num_rows($chk);
                            if($row==1){
                                continue;
                            }


                            echo "<h2>TOPIC :".$subject ."</h2>";
                            
                            echo "
                            <form action='script/feedbackentry.php? method='get'>
                                <table>
                                    
                            ";

                            $qry = "SELECT  topic FROM feedbacklog WHERE subject='$subject'";
                            $res = mysqli_query($con,$qry);
                            while($data = mysqli_fetch_assoc($res)){

                                

                                echo "<tr>
                                <td>".$data['topic']."</td>
                                <td>understood <input type='radio' name=".$data['topic']." value='u' checked></td>
                                <td>not understood <input type='radio' name=".$data['topic']." value='nu'></td>
                                <td>partial understood <input type='radio' name=".$data['topic']." value='pu'></td>
                                
                                </tr>";
                            }

                            echo"
                                <input type='hidden' name='subject' value=".$subject.">
                                <tr><td><input type='submit'></td></tr>
                              </table>
                            </form>";
                        }


                    }
                ?>
            </div>
        </div>
    </body>
    </html>
  
  
    