<?php
include("sessioncheck.php");
if(isset($_POST['update'])){
//collecting data for update process
$uid=$_POST['uid'];
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$role=$_POST['role'];
$status=$_POST['status'];

if(!empty($password))
{
    $sql ="UPDATE users SET username='$username', password=md5('$password'), email='$email', role='$role', status=$status WHERE id=$uid";
}
else{
    $sql ="UPDATE users SET username='$username', email='$email', role='$role', status=$status WHERE id=$uid";
}
include("../connection.php");
$qry=mysqli_query($conn, $sql)or die(mysqli_error($conn));
if($qry){
    header("Location:usermgmt.php");
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT DELETE USERS</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
   <div class="row">
    <div class="col-xxl-12">
    <?php
    include("topmenu.php");
    ?>
    </div>
</div>
<div class="row">
    <div class="col-xxl-12">List Users <br>
    <?php
    $uid=$_GET['id'];
    $action=$_GET['action'];
    if(!empty($uid) && $action=="delete")
    {

        $sql="DELETE FROM users WHERE id=$uid";
        include("../connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($qry){
            header("Location:usermgmt.php");

        }

    }
    elseif(!empty($uid) && $action=="edit"){
        //SQL for selecting the related records info
        $sql = "SELECT * FROM users WHERE id=$uid ";
        include("../connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row=mysqli_fetch_array($qry)){
            $eid=$row['id'];
            $eusername=$row['username'];
            $eemail=$row['email'];
            $erole=$row['role'];
            $estatus=$row['status'];
        echo "<form action='' method='post'>";
        echo "<fieldset><legend>".$uid. "Edit</legend>";
        echo "<input type=number name=uid value=$eid readonly>";
        echo "<br>";
        echo "<input type=text name=username value='$eusername'>";
        echo "<br>";
        echo "<input type=text name=password placeholder=Password>";
        echo "<br>";
        echo "<input type=email name=email value=$eemail>";
        echo "<br>";
        echo "<input type=text name=role value='$erole'>";
        echo "<br>";
        echo "<input type=number name=status value='$estatus'>";
        echo "<br>";
        echo "<input type=submit name=update value=Edit>";


        echo "</fieldset>";
        echo "</form>";
    }


    }
    else{
        header("Location:usermgmt.php");
    }
   
   
    
    

    ?>



    </div>
    
</div>


<div class="row">
    <div class="col-xxl-12">

    <?php
include("footer.php");
?>
</div>
</div>

 </div>
</body>
</html>

