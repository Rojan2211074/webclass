<?php
include("sessioncheck.php");

if(isset($_POST['register'])){
    //getting users info
    $user=$_POST["username"];
    $pass=md5($_POST["password"]);
    $email=$_POST["email"];
    $role=$_POST["role"];
    $status=$_POST["status"];
    //Preparing the sql statement
    $sql = "INSERT INTO users(username, password, email, role, status)VALUES('$user', '$pass', '$email','$role', '$status')";
    //making connection
    include_once("../connection.php");
    //executing query
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($qry){
        echo "Data Inserted Successfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
    <div class="col-xxl-6">List Users <br>
    <?php
    $sql="SELECT * FROM users ORDER BY id DESC";
    include("../connection.php");
    $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count=mysqli_num_rows($qry);
    if($count>=1)
    {
    echo "We have total $count Records";
    echo "<table class='table table-striped table-hover'>";
    echo "<tr><thead><th>SN</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th></th></tr>";
    while($row=mysqli_fetch_array($qry)){
        $id=$row['id'];
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['role']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "<td><a href=editdeleteuser.php?id=$id&action=edit>EDIT</a> | <a href=editdeleteuser.php?id=$id&action=delete>DELETE</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    
    }
    else
    {
        echo "Sorry No Users Found";
    }
    ?>



    </div>
    <div class="col-xxl-6">

    <form method="post" action="" name="login" enctype="multipart/form-data">
        <fieldset>
            <legend>Add USer</legend>
            <input type="text" name="username" placeholder="Username">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="email" name="email" placeholder="you@domain.com">
            
            <br>
            <select size=1 name=role>
                <option value=user>User</option>
                <option value=admin>Admin</option>
            </select>
            <br>
            <select size=1 name=status>
                <option value=1>Active</option>
                <option value=0>Deactive</option>
            </select>
            <br>
            <input type="submit" name="register" value="Register">
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

