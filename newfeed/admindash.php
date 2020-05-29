
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="css/admin.php">
</head>
</html>
<?php
    include "includes/session.php";
    include "includes/connection.php";

    if(isset($_GET['logout']))
    {
        header("location:script/logout.php");
    }


    if(isset($_SESSION['person']))
    {
        //admin working
        if($_SESSION['person']=="admin")
        {
            echo  "
                <div class='leftpanel'>
                <h2 id='admin'>Admin Dashboard</h2>
                <a href='admindash.php?addstudent=true' class=options >Add Students</a>
                <a href='admindash.php?addteacher=true' class='options'>Add Teachers</a>
                <a href='admindash.php?studentdata=true' class='options'>Show Students Data</a>
                <a href='admindash.php?showdata=true' class='options'>Show Teachers Data</a>
                <a href='script/logout.php' class='options'>Logout</a>
        </div>
                    ";

            if(isset($_GET['addstudentdata']))
            {
                echo "<br><br><center><h2>student data added successfully</h2></center>";
            }

            //adding student data
            if(isset($_GET["addstudent"]))
            {
                echo "<br><br><center><h1>Add Students Records</center></h1>";
                echo '
                  <form action="script/addstudent.php" method="post">
                  <br><br><br>
                    <table id="tbl">
                    <tr>
                        <td>Roll Number</td>
                        <td><input type="text" name="rollnumber" required></td>
                    </tr>

                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="fname" required></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="lname" required></td>
                    </tr>
                    <tr>
                        <td>Email Id</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>

                      </tr>

                    </table>
                    <center>
                    <select  name="branch" class="sel">
                        <option value="IT">IT</option>
                        <option value="CS">CS</option>
                        <option value="ENTC">ENTC</option>
                    </select>

                    <select  name="year" class="sel">
                        <option value=1>First</option>
                        <option value=2>Second</option>
                        <option value=3>Third</option>
                        <option value=4>Fourth</option>
                    </select>
                     
                    <br>
                    <br>
                    <input type="Submit" value="submit" name="submit" class="bot"></center>
                  </form>
                ';
            }


            //displaying student data
            if(isset($_GET["studentdata"]))
            {
                echo "<br><br><center><h1>Student Data</h1><br>";
                echo '<table>
                    <tr>
                        <th>Roll Number</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Branch</th>
                        <th>Year</th>
                        <th>Email</th>
                        
                    </tr>';

                $query = "SELECT * FROM student";
                $result = mysqli_query($con,$query);
                $row = mysqli_num_rows($result);

                for($i=0;$i<$row;$i++)
                {
                    $data = mysqli_fetch_assoc($result);
                    $rollnumber = $data['rollnumber'];
                    $fname = $data['firstname'];
                    $lname = $data['lastname'];
                    $branch = $data['branch'];
                    $year = $data['year'];
                    $email = $data['email'];
                    $password = $data['password'];


                    echo '<tr>
                        <td>'.$rollnumber.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$branch.'</td>
                        <td>'.$year.'</td>
                        <td>'.$email.'</td>
                    </tr>';
              }

              echo "</table>";
            }


            //adding teacher data
            if(isset($_GET['success']))
            {
                echo "<br><br><center><h2>teacher data updated successfully</h2>";
            }

            if(isset($_GET["addteacher"]) || isset($_GET['success']))
            {
                echo "<br><br><center><h1>Add Teachers Records<br><br></center></h1>";
                echo '
                <form action="script/addteacher.php" method="post">
                <table id="tbl2">
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="fname" required></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lname" required></td>
                </tr>
                <tr>
                    <td>Email Id</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                <td>Birth Date </td>
                <td><input type="date" name="dob" required></td><br>
                </tr>
                <tr>

                </tr>

                </table>
                <center>
                <select  name="branch" class="sel">
                        <option value="IT">IT</option>
                        <option value="CS">CS</option>
                        <option value="ENTC">ENTC</option>
                </select>
                <br><br>
                <input type="submit" value="submit" name="submit" class="bot">
                </center>
                </form>
                ';
            }

            //show teachers data
            if(isset($_GET['showdata']))
            {
                echo "<br><br><center><h1>Teacher Data</h1><br>";
                echo '<table>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Date Of Birth</th>
                        <th>Password</th>
                    </tr>';

                $query = "SELECT * FROM teachers";
                $result = mysqli_query($con,$query);
                $row = mysqli_num_rows($result);

                for($i=0;$i<$row;$i++)
                {
                    $data = mysqli_fetch_assoc($result);
                    $fname = $data['firstname'];
                    $lname = $data['lastname'];
                    $email = $data['email'];
                    $branch = $data['branch'];
                    $dob = $data['dob'];
                    $password = $data['password'];

                    echo '<tr>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$branch.'</td>
                        <td>'.$dob.'</td>
                        <td>'.$password.'</td>
                    </tr>';
                }

                echo "</table>";
            }
        }
        else
        {
            header("location:index.php?person=unknownadmin");
        }
    }
    else
    {
        header("location:index.php?person=unknownadmin");
    }

?>
