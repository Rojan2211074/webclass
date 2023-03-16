<?php
session_start();
if(isset($_POST['submit']))
{
    $message=$_POST['message'];
    $article_id=$_POST['article_id'];
    $user_id=$_POST['user_id'];
    $status=0;

    if(!empty($message))
    {
        $sql="INSERT into comment (user_id, article_id, message, status) VALUES($user_id, $article_id, '$message', $status)";
        include("connection.php");
        $qry=mysqli_query($conn, $sql) or die("unable to insert comment");
        if($qry){
            $cmtmsg="Thank you for your comment. You comment will be published after verification.";
           
        }

    }
    else{
        echo "Please write the Coments";
    }

   

}

?>
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
       if(!isset($_GET['id']))
       {
        header("Location:index.php");
       }
       $aid=$_GET["id"];
            

                $sql="SELECT * from article WHERE id='$aid'" ;
                include("connection.php");
                $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $count=mysqli_num_rows($qry);
                if($count>=1){
                   

                    while($row=mysqli_fetch_array($qry)){
                        $img=$row['featureimg'];
                        $title=$row['title'];
                        $desc=$row['description'];
                        $user_id=$row['user_id'];

                        $sqlauth="SELECT * FROM users WHERE id=$user_id";
                        $qryuser=mysqli_query($conn, $sqlauth);
                        while($rowauth=mysqli_fetch_array($qryuser)){
                            $authusername=$rowauth["username"];
                        }


                        echo "<div class=row>
                        <div class=col-xxl-12>
                        <img src='uploads/article/$img' alt='$title' class='img-fluid'>
                        <h2>$title</h2>
                        <p>$desc</p>
                        <p>Author: $authusername</a>

                        
                    
                        </div></div>";
                    }
                    if(isset($cmtmsg)){
                        echo "<p>".$cmtmsg."</p>";
                        echo "<hr>";
                    }

                    if(isset($_SESSION["username"]) and isset($_SESSION["userid"])){
                        echo "<h2>Post Your Coment</h2>";
                        echo "<form method=post name=postcomment action=''>";
                        echo "<fieldset><legend>Post Comment</legend>";
                        echo "<textarea rows=10 cols=50 name=message></textarea>";
                        echo "<input type=hidden name=article_id value=$aid>";
                        echo "<input type=hidden name=user_id value=".$_SESSION['userid'].">";
                        echo "<input type=submit name=submit value=post comment>";
                        echo "</fieldset></form>";

                    }


                    echo "<div class=row>";
                    $sql="SELECT users.id, users.username, comment.id, comment.user_id, comment.article_id, comment.message, comment.status FROM users, comment WHERE comment.article_id=$aid and users.id=comment.user_id and comment.status=1";
                    $qry=mysqli_query($conn, $sql) or die("unable to get the data");
                    $count=mysqli_num_rows($qry);
                    if($count>=1)
                    {
                        while($row=mysqli_fetch_array($qry))
                        {

                        echo "<div class=col-xxl-12>";
                        echo "<p>".$row['message']."</p>";
                        echo "<p>".$row['username']."</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<hr>";
                        }
                    

                    }
                    else{
                        echo "No Comments Yet. Be  a first for publishing a commnet";
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