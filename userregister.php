<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        //getting users info
        $user=$_POST["username"];
        $pass=md5($_POST["password"]);
        $email=$_POST["email"];
        //Preparing the sql statement
        $sql = "INSERT INTO users(username, password, email)VALUES('$user', '$pass', '$email')";
        //making connection
        include_once("connection.php");
        //executing query
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($qry){
            echo "Data Inserted Successfully";
        }
    }
    ?>
    <h1>User Registration Form</h1>
    <form method="post" action="" name="login" enctype="multipart/form-data">
        <fieldset>
            <legend>UserRegistration</legend>
            <input type="text" name="username" placeholder="Username">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="email" name="email" placeholder="you@domain.com">
            <br>
            <input type="submit" name="submit" value="Register">
    </fieldset>
    </form>
    <p>Already Registered. <a href="login.php">Login</a></p>
    
</body>
</html>