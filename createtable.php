<?php
$sql ="
    CREATE TABLE IF NOT EXISTS users(
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(250) NOT NULL,
        email VARCHAR(50) UNIQUE,
        role VARCHAR(5) NOT NULL DEFAULT 'user',
        status TINYINT(1) NOT NULL DEFAULT '0'
    )
";
//connecting to db
include_once("connection.php");
//executing query
$qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
if($qry){
    echo "users Table created Successfully";
}
?>