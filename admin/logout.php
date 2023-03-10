<?php
include("sessioncheck.php");
//clear all the existing session
session_destroy();
header("Location:../login.php");
?>