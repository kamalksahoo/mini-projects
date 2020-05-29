<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="x.php">
</head>
<body>
    
</body>
</html>
<?php
 //sending email
    echo '<link href="x.css">'; 
    echo '<p class="b">hello</p>';
    if(mail("roshankajulkar@gmail.com","login","
    username is yxz@gmail.com 
    pass is 123456 
    please change it as ssoon as possible
    
    ")){
        echo "success";
    }
    else
    {
        echo "failed";
    }