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
    <title>teacher dashboard</title>
    <link rel="stylesheet" href="css/teacher.php">
    <script src="https://cdn.plot.ly/plotly-latest.min.js">
    </script>
</head>
<body>
    
<div>
            <div class="left-bar">
                <h2 id="head">Teacher dashboard</h1>
                <a href="teacherdash.php?teacherprofile=true" class="options">Teacher Profile</a>
                <a href="teacherdash.php?addfeedback=true" class="options">Add feedback</a>
                <a href="teacherdash.php?checkfeedback=true" class="options">Check feedback</a>
                <a href="script/logout.php" class="options">Logout</a>
            </div>
            <div class="main">
            <?php 
                echo "<h2 id='main-head'>".$_SESSION['firstname']." ".$_SESSION['lastname']."</h2>";
                
                //teacher profile display
                
                if(isset($_GET['teacherprofile'])){
                    echo "
                        <div id='imgg'>
                            <img src='asset/studentlogo.png' alt='logo' id='img'>
                        </div>
                        <table id='tbl'>
                            <tr>
                                <td class='td'>Teacher ID</td>
                                <td class='td'>".$_SESSION['teacher_id']."</td>
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
                                <td class='td'>Date of birth</td>
                                <td class='td'>".$_SESSION['dob']."</td>
                            </tr>
                        </table>
                    ";
                }else if(isset($_GET['addfeedback']) or isset($_GET['subjectname']) or isset($_GET['num'])){
                    //teacher add feedback    
                    if(!isset($_GET['subjectname']) and !isset($_GET['num'])){
                        echo "
                        <div id='subject'>
                        <form action='teacherdash.php' method='GET'>
                        <h1>Select the subject</h1>
                        ";

                        foreach($_SESSION['subjectidlist'] as $x){
                            $subjectname = $_SESSION['subjectnamelist'][$x];
                            
                            $qry = "SELECT * FROM feedback_generated WHERE subject='$subjectname'";
                            $chk =  mysqli_query($con,$qry);
                            $row = mysqli_num_rows($chk);

                            if($row==1){
                                continue;
                            }

                            echo "<input type='submit' value=".$subjectname." name='subjectname' class='input'>";
                        }
                        echo "
                        </form>
                        </div>";
                    }else if(!isset($_GET['num'])){
                        $_SESSION['subject'] = $_GET['subjectname'];
                        echo "
                        <div id='subject'>
                        <form action='teacherdash.php' method='GET'>
                        <h1>Topics covered</h1>
                        <input type='number' name='num' class='input'>
                        <input type='submit' name='submit' class='input'>
                        </form>
                        </div>";
                    }else{
                        $num =  $_GET['num'];
                        echo "
                        <form action='script/addfeedback.php' method='GET'>";
                        
                        for($i=0;$i<$num;$i++){
                            echo"<input type='text' name='feedback[]' required placeholder='topic'><br>";
                        }
                        echo "<input type='submit'></form>";
                    }
                       
                }
                
                else if(isset($_GET['success'])){
                    echo "feedback generated successfully";
                }
                //checking the feedback
                else if(isset($_GET['checkfeedback'])){

                    $i=1;

                    foreach($_SESSION['subjectidlist'] as $x){
                        $subjectname = $_SESSION['subjectnamelist'][$x];
                        
                        $qry = "SELECT * FROM feedback_generated WHERE subject='$subjectname'";
                        $chk =  mysqli_query($con,$qry);
                        $row = mysqli_num_rows($chk);
                        if($row==1){
                            $qry = "SELECT topic,understood,notunderstood,partialunderstood FROM feedbacklog WHERE subject='$subjectname';";
                            $chk =  mysqli_query($con,$qry);

                            echo "
                                <div class='feedback'>
                                    <h2>".$subjectname."</h2>
                                
                                
                            ";
                            while($data = mysqli_fetch_assoc($chk)){
                                $topic = $data['topic'];
                                $un = $data['understood'];
                                $nu =  $data['notunderstood'];
                                $pu =  $data['partialunderstood'];
                                $div = "MyDiv".$i;
                                $i++;
                                echo "
                                    <p>TOPIC : ".$topic."</p>
                                    <div id=".$div." style='height: 370px; width: 900px;'></div>
                                    <script>
                                    var xValue = ['understood', 'not understood', 'partially understood'];
    
                                    var yValue = [".$un.",".$nu.",".$pu."];
    
                                        var trace1 = {
                                        x: xValue,
                                        y: yValue,
                                        type: 'bar',
                                        text: yValue.map(String),
                                        textposition: 'auto',
                                        hoverinfo: 'none',
                                        marker: {
                                            color: 'rgb(158,202,225)',
                                            opacity: 0.6,
                                            line: {
                                            color: 'rgb(8,48,107)',
                                            width: 1.5
                                            }
                                        }
                                        };
    
                                    var data = [trace1];
    
                                    var layout = {
                                        
                                        };
    
                                    Plotly.newPlot(".$div.", data, layout, {staticPlot: true});
    
                                    </script>

                                ";
                            }
                            echo "</div><hr>";

                        }
                    }
                }
            ?>
            </div>
        </div>
</body>
</html>



