<?php
include("sessioncheck.php");

if(isset($_POST['addarticle'])){
    //getting users info
 
    $title=$_POST["title"];
    $category_id=$_POST["category_id"];
    $description=$_POST["description"];
    $user_id=$_POST["user_id"];
    $status=$_POST["status"];
    //to capture the image name
    $imgname=$_FILES["featureimg"]["name"];
    //to capture the image size
    $size=$_FILES["featureimg"]["size"];
    //to capture the image type
    $type=$_FILES["featureimg"]["type"];
    //to capture the temporary name
    $tmpname=$_FILES["featureimg"]["tmp_name"];
    //file upload location
    $uploadlocation="../uploads/article/".$imgname;
    //moving the uploaded file into uploads directory
    //Preparing the sql statement
    $sql = "INSERT INTO article(category_id, user_id, title, description,featureimg,status)VALUES('$category_id','$user_id','$title','$description', '$imgname', '$status')";
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
    echo "<tr><thead><th>SN</th><th>CategoryID</th><th>UserID</th><th>Title</th><th>Description</th><th>Feature Image</th><th>Status</th><th></th></tr>";
    while($row=mysqli_fetch_array($qry)){
        $id=$row['id'];
        $image=$row['featureimg'];
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['category_id']."</td>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td></td>";
        echo "<td><img src='../uploads/article/".$image."' width='150px'></td>";

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
            <br>
            <input type="text" name="title" placeholder="Title">
          
            
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['userid'];?>">
            <br>
            <select name='category_id'>
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
            <textarea rows=10 cols=50 name="description"> </textarea>
            <br>
            <input type="file" name="featureimg">
            <br>
            <select size=1 name=status>
                <option value=1>Active</option>
                <option value=0>Deactive</option>
            </select>
            <br>
            <input type="submit" name="addarticle" value="Insert">
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

