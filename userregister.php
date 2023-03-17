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
            // Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <lalpower77@gmail.com>' . "\r\n";
$headers .= 'Cc: maharjanoptex@gmail.com' . "\r\n";

$message = "Thank you for registration with us <b>Hi ".$user."</b> , Thank you for registration with us. Please clcik below link to verify your account. ";

$message.="<a href=http://172.16.3.52/group02/verify.php?username=$user&email=$email>Verify</a>";
$subject= "Thank you for registration with us";

if(mail($email, $subject,  $message, $headers)){
    echo "Email Send";
}
else{
    echo "Unable to send the email";
}
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