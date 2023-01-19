<?php
    session_start();
    //error_reporting(0);
    include('includes/config.php');
    if (strlen($_SESSION['aid']==0)) {
        header('location:logout.php');
        } 
        else{
            // Add Category Code
            if(isset($_POST['submit'])){
                //Getting Post Values
                $catname=$_POST['category']; 
                $catcode=$_POST['categorycode'];   
                $query=mysqli_query($con,"INSERT INTO tblcategory(CategoryName,CategoryCode) VALUES('$catname','$catcode')"); 
                if($query){
                    echo "<script>alert('Category added successfully.');</script>";   
                    echo "<script>window.location.href='add-category.php'</script>";
                }
                else{
                    echo "<script>alert('Something went wrong. Please try again.');</script>";   
                    echo "<script>window.location.href='add-category.php'</script>";    
                }
    }
?>
<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
            crossorigin="anonymous">
    
    <style>
        .input:focus,
        .input:hover{
            outline:none;
            border:2px solid #2593b8;
        }
    </style> 
    </head>

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./includes/style.css">

    <title>Add Category</title>
    </head>
    <body>
        <!--header area start-->
        <header>
        <!--
            <label for="check">
                <i class="fas fa-bars" id="sidebar_btn"></i>
            </label>
        -->
            <div class="left_area">
                <h3>HP <span>DAIRY</span></h3>
            </div>

            <div class="right_area">
                <a href="logout.php" class="logout_btn">Logout</a>
            </div>
            
            <div class="right_area">
                <a href="setting.php" class="setting_btn">Setting</a>
            </div>

            <div class="right_area">
                <a href="profile.php" class="profile_btn">Profile</a>
            </div>

        </header>
        <!--header area end-->

        <!--sidebar start-->
        <div class="sidebar">
            <a href="dashboard.php"><i class="fa fa-th"></i><span>Dashboard</span></a>
            <a href=""><i class="fa fa-file-text"></i><span>Add Category</span></a>
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
                <div class="card-title">
                    <h2><i class="fa fa-file-text"></i> Add Category</h2>
                </div>
            </div>
            <div class="cardbox">
                <form method="post">
                    <div class="form-group">
                        <div class="product-label">
                            <label class="categoryname">Category Name</label>
                        </div>
                        <input type="text" class="input" name="category" id="categoryname" placeholder="Category Name" required>                
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="product-label">
                            <label class="categorycode">Category Code</label>
                        </div>
                        <input type="text" class="input"  name="categorycode" id="categorycode" placeholder="Category Code" required>
                    </div>
                    <br>
                
                    <button type="submit" class="btn btn-lg btn-block" name="submit" href="">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
  }
?>