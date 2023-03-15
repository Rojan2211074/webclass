<div class="row">
            <div class="col-xxl-12">
                Banner
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyBlog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php
        $sql ="SELECT * FROM category order by id DESC LIMIT 0,6";
        include("connection.php");
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        while($row=mysqli_fetch_array($qry))
        {
            echo "<li class=\"nav-item\">
            <a class=\"nav-link\" href=category.php?id=".$row['id'].">".$row['name']."</a>
        </li>";
        }
        ?>

        <?php
        if(!isset($_SESSION["username"]))
        {
  echo "        
<li class=\"nav-item\">
<a class=\"nav-link\" aria-current=\"page\" href=\"register.php\">Register</a>
</li>";

echo "        
<li class=\"nav-item\">
<a class=\"nav-link\" aria-current=\"page\" href=\"login.php\">Login</a>
</li>";


        }
        else{

          echo "Welcome, ".$_SESSION['username']."    
<li class=\"nav-item\">
<a class=\"nav-link\" aria-current=\"page\" href=\"admin/logout.php\">Logout</a>
</li>";

        }
        ?>



      
      </ul>
      <form method="post" class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchkey">
        <button class="btn btn-outline-success" type="submit" name ="search" >Search</button>
      </form>
    </div>
  </div>
</nav>
            </div>
        </div>
