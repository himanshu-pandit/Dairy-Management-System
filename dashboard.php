<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <link href="./includes/style.css" rel="stylesheet" type="text/css">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
                integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
                crossorigin="anonymous">
    <!--/Font Awesome-->
        
</head>
<body>


    <!--header area start-->
    <header>
        <div class="left_area">
            <h3>HP <span>DAIRY</span></h3>
        </div>

        <div class="right_area">
            <a class="logout_btn" href="./logout.php">Logout</a>
        </div>
        
        <div class="right_area">
            <a href="./setting.php" class="setting_btn" >Setting</a>
        </div>

        <div class="right_area">
            <a href="./profile.php" class="profile_btn">Profile</a>
        </div> 
    </header>
    <!--header area end-->

    <!--sidebar start-->
    <div class="sidebar">
        <a href=""><i class="fa fa-th"></i><span>Dashboard</span></a>
        <a href="./add-category.php"><i class="fa fa-file-text"></i><span>Add Category</span></a>
        <a href="./manage-categories.php"><i class="fa fa-file-text"></i><span>Manage Category</span></a>
        <a href="./add-product.php"><i class="fa fa-list-alt"></i><span>Add Product</span></a>
        <a href="./manage-products.php"><i class="fa fa-list-alt"></i><span>Manage Product</span></a>
        <a href="./add-company.php"><i class="fa fa-file-text"></i><span>Add Company</span></a>
        <a href="./manage-companies.php"><i class="fa fa-file-text"></i><span>Manage Company</span></a>
        <a href="./search-products.php"><i class="fa fa-search"></i><span>Search Product</span></a>
        <a href="./Invoices.php"><i class="fas fa-file-invoice"></i><span>Invoices</span></a>
        
    </div>
    <!--sidebar end-->
    <div class="content">
    
    <div class="cardbox">
            <!-- Title -->
            <div class="card-title">
                <h2><i class="fa fa-th"></i> Dashboard</h2>
            </div>
            <!-- /Title -->
            <form>
                <div class="cards_wrap">
                    <?php
                        $query=mysqli_query($con,"select id from tblcategory");
                        $listedcat=mysqli_num_rows($query);
                    ?>
                    <div class="card_item">
                        <div class="card_inner">
                            <div class="title">Categories</div>
                            <div class="number"><?php echo $listedcat;?></div>
                            <div class="des">Listed Category</div>
                        </div>
                    </div>

                    <?php
                        $query=mysqli_query($con,"select id from tblcompany");
                        $listedcom=mysqli_num_rows($query);
                    ?>
                    <div class="card_item">
                        <div class="card_inner">
                            <div class="title">Companies</div>
                            <div class="number"><?php echo $listedcom;?></div>
                            <div class="des">Listed Company</div>
                        </div>
                    </div>

                    <?php
                        $query=mysqli_query($con,"select id from tblproducts");
                        $listedpro=mysqli_num_rows($query);
                    ?>
                    <div class="card_item">
                        <div class="card_inner">
                            <div class="title">Products</div>
                            <div class="number"><?php echo $listedpro;?></div>
                            <div class="des">Listed Products</div>
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>
<?php } ?>