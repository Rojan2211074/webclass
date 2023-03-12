<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog </title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php include("inc_bannermenu.php");?>
        
       <div class="row">
       <?php
            

                $sql="SELECT * from article  ORDER BY id DESC LIMIT 0,5" ;
                include("connection.php");
                $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $count=mysqli_num_rows($qry);
                if($count>=1){
                   

                    while($row=mysqli_fetch_array($qry)){
                        $img=$row['featureimg'];
                        $title=$row['title'];
                        $desc=substr($row['description'],0,400);

                        echo "<div class=row>
                        <div class=col-xxl-12>
                        <img src='uploads/article/$img' alt='$title' class='img-fluid'>
                        <h2>$title</h2>
                        <p>$desc</p>
                    
                        </div></div>";
                    }

              



            }

            ?>
        </div>
        
    </div>

<?php
include("inc_footer.php");
?>
    
</body>
</html>