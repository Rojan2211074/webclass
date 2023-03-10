<?php
include("sessioncheck.php");

if(isset($_POST['addcategory'])){
    //getting users info
    $name=$_POST["name"];
    $description=$_POST["description"];
    $status=$_POST["status"];
    //to capture the image name
    $imgname=$_FILES["thumbimg"]["name"];
    //to capture the image size
    $size=$_FILES["thumbimg"]["size"];
    //to capture the image type
    $type=$_FILES["thumbimg"]["type"];
    //to capture the temporary name
    $tmpname=$_FILES["thumbimg"]["tmp_name"];
    //file upload location
    $uploadlocation="../uploads/".$imgname;
    //moving the uploaded file into uploads directory
    //Preparing the sql statement
    $sql = "INSERT INTO category(name, description, thumbimg, status)VALUES('$name', '$description', '$imgname', '$status')";
    //making connection
    include_once("../connection.php");
    //executing query
    if(move_uploaded_file($tmpname, $uploadlocation))
    {
        echo "File uloaded";
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($qry){
            echo "Data Inserted Successfully";
        }
    }
    else{
        echo "unable to upload the file";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Category Management</title>
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
    <div class="col-xxl-6">List Artcle <br>
    <?php
    $sql="SELECT * FROM article ORDER BY id DESC";
    include("../connection.php");
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count=mysqli_num_rows($qry);
    if($count>=1)
    {
    echo "We have total $count Records";
    echo "<table class='table table-striped table-hover'>";
    echo "<tr><thead><th>SN</th><th>CategoryID</th><th>UserID</th><th>Title</th><th>Status</th><th></th></tr>";
    while($row=mysqli_fetch_array($qry)){
        $id=$row['id'];
        $image=$row['featureimg'];
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['category_id']."</td>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "<td><a href=editdeletearticle.php?id=$id&action=edit>EDIT</a> | <a href=editdeletearticle.php?id=$id&action=delete&img=$image>DELETE</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    
    }
    else
    {
        echo "Sorry No Article Found";
    }
    ?>



    </div>
    <div class="col-xxl-6">

    <form method="post" action="" name="article" enctype="multipart/form-data">
        <fieldset>
            <legend>Add Article</legend>
            <select>
                <?php
                $sql="SELECT * FROM category ORDER BY id DESC";
                include("../connection.php");
                $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($row=mysqli_fetch_array($qry))
                {
               
                echo "<option value=".$row['id']."> ".$row['name']."</option>";
                
                 }
                ?>
            </select>
            <br>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid'];?>">
            <br>
            <input type="text" name="name" placeholder="Category Name">
            <br>
            <input type="text" name="description" placeholder="Description">
            <br>
            <input type="file" name="thumbimg">
            <br>
            <select size=1 name=status>
                <option value=1>Active</option>
                <option value=0>Deactive</option>
            </select>
            <br>
            <input type="submit" name="addcategory" value="Insert">
    </fieldset>
    </form>
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

