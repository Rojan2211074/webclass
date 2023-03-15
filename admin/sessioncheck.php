<?php
session_start();
if(!isset($_SESSION["username"])&& !isset($_SESSION["accesstime"])){
    
    header("Location:../login.php");
    
}
else if($_SESSION['userrole']=='user'){
   
    header("Location:../index.php");

}
?>