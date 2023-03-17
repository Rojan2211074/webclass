<?php
if(!isset($_GET['username'])&!isset($_GET['email']))
{
    header("Location:http://172.16.3.52/group02/");
}
else{

    $email=$_GET["email"];
    $username=$_GET["username"];

    include("connection.php");
    $sql="UPDATE users SET status=1 WHERE username='$username' and email='$email'";
    $qry=mysqli_query($conn, $sql) or die("Unable to verify user");
    if($qry)
    {
        header("Location:http://172.16.3.52/group02/login.php");

    }

}
?>