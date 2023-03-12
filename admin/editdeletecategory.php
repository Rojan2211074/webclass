<?php
include("sessioncheck.php");
if(isset($_POST['update'])){
//collecting data for update process
$uid=$_POST['uid'];
$name=$_POST['name'];
$description=$_POST['description'];
$status=$_POST["status"];

$oldthumbimg=$_POST['oldimage'];
$imgname=$_FILES['thumbimg']["name"];
$size=$_FILES["thumbimg"]["size"];
$type=$_FILES["thumbimg"]["type"];
$tmpname=$_FILES["thumbimg"]["tmp_name"];
$uploadlocation="../uploads/category/".$imgname;





if(!empty($name))
{
    $sql ="UPDATE category SET name='$name', description='$description', thumbimg='$imgname', status=$status WHERE id=$uid";
}

include("../connection.php");
$qry=mysqli_query($conn, $sql)or die(mysqli_error($conn));
if(move_uploaded_file($tmpname, $uploadlocation))
{
    echo "File uloaded";
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($qry){
    echo "Data Inserted Successfully";
    header("Location:categorymgmt.php");
    unlink("../uploads/category/".$oldthumbimg);

    }
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
    <div class="col-xxl-12">List Categories <br>
    <?php
    $uid=$_GET['id'];
    $action=$_GET['action'];
    
    if(!empty($uid) && $action=="delete")
    {
        $image=$_GET['img'];

        $sql="DELETE FROM category WHERE id=$uid";
        include("../connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($qry){
            unlink("../uploads/category/".$image);
            header("Location:categorymgmt.php");

        }

    }
    elseif(!empty($uid) && $action=="edit"){
        //SQL for selecting the related records info
        $sql = "SELECT * FROM category WHERE id=$uid";
        include("../connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row=mysqli_fetch_array($qry)){
            $eid=$row['id'];
            $ename=$row['name'];
            $edescription=$row['description'];
            $ethumbimg=$row['thumbimg'];
            $oldthumbimg=$row['thumbimg'];

            $estatus=$row['status'];
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        echo "<fieldset><legend>".$uid. "Edit</legend>";
        echo "<input type=number name=uid value=$eid readonly>";
        echo "<br>";
        echo "<input type=text name=name value='$ename'>";
        echo "<br>";
        echo "<textarea rows=10 name=description cols=50> $edescription </textarea>"
        
        echo "<br>";
        echo "<input type='file' name='thumbimg'>";
        // echo "<br>";
        echo "<input type=hidden name=oldimage value='$oldthumbimg'>";
        echo "<br>";
        echo "<input type=number name=status value='$estatus'>";
        echo "<br>";
        echo "<input type=submit name=update value=Edit>";


        echo "</fieldset>";
        echo "</form>";
    }


    }
    else{
        header("Location:categorymgmt.php");
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

