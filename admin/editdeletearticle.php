<?php
include("sessioncheck.php");
if(isset($_POST['update'])){
//collecting data for update process
$article_id=$_POST['aid'];
$category_id=$_POST['cid'];
$user_id=$_POST['uid'];
$title=$_POST['title'];
$description=$_POST['description'];
$status=$_POST["status"];

$oldfeatureimg=$_POST['oldimage'];
$imgname=$_FILES['featureimg']["name"];
$size=$_FILES["featureimg"]["size"];
$type=$_FILES["featureimg"]["type"];
$tmpname=$_FILES["featureimg"]["tmp_name"];
$uploadlocation="../uploads/article/".$imgname;

if(!empty($title))
{
    $sql ="UPDATE article SET id='$article_id', category_id='$category_id', user_id='$user_id', title='$title', description='$description',featureimg='$imgname', status=$status WHERE id=$article_id";
}

include("../connection.php");
$qry=mysqli_query($conn, $sql)or die(mysqli_error($conn));
if(move_uploaded_file($tmpname, $uploadlocation))
{
    
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($qry){
    
    header("Location:articlemgmt.php");
    unlink("../uploads/article/".$oldfeatureimg);

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
        $sql = "SELECT * FROM article WHERE id=$uid";
        include("../connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row=mysqli_fetch_array($qry)){
            $eid=$row['id'];
            $ecategory_id=$row['category_id'];
            $euser_id=$row['user_id'];
            $etitle=$row['title'];
            $edescription=$row['description'];
            $efeatureimg=$row['featureimg'];
            $eoldthumbimg=$row['featureimg'];
            $estatus=$row['status'];
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        echo "<fieldset><legend>".$uid. "Edit</legend>";
        echo "Article ID";
        
        echo "<input type=number name=aid value=$eid readonly>";
        echo "<br>";
        echo "catID";
        echo "<input type=number name=cid value=$ecategory_id>";
        echo "<br>";
        echo "userID";
        echo "<input type=text name=uid value='$euser_id'>";
        echo "<br>";
        echo "Title";
        echo "<input type=text name=title value='$etitle'>";
        echo "<br>";
        echo "Descirioption";

        echo "<input type=text name=description value='$edescription'>";
        echo "<br>";
        echo "<input type='file' name='featureimg'>";
        // echo "<br>";
        echo "<input type=hidden name=oldimage value='$eoldthumbimg'>";
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

