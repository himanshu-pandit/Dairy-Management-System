<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add product Code
if(isset($_POST['submit']))
{
//Getting Post Values
$catname=$_POST['category']; 
$company=$_POST['company'];   
$pname=$_POST['productname'];
$pprice=$_POST['productprice'];
$query=mysqli_query($con,"insert into tblproducts(CategoryName,CompanyName,ProductName,ProductPrice) values('$catname','$company','$pname','$pprice')"); 
if($query){
echo "<script>alert('Product added successfully.');</script>";   
echo "<script>window.location.href='add-product.php'</script>";
} else{
echo "<script>alert('Something went wrong. Please try again.');</script>";   
echo "<script>window.location.href='add-product.php'</script>";    
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
            .select{
            padding:12px 12px;
            color:#2593b8;
            width:42%;
            background-color:#eeeeee;
            border: 2px solid #2593b8;
            cursor:pointer;
            border-radius:5px;
            font-size: 16px;
            }

            .select:focus,
            .select:hover{
                outline:none;
                border:2px solid #2593b8;   
            }
            
            .input:focus,
            .input:hover{
                outline:none;
                border:2px solid #2593b8;
            }

        </style>
        
        </head>
    
        <!-- Custom Styles -->
        <link rel="stylesheet" type="text/css" href="./includes/style.css">
    
        <title>Add Product</title>
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
                    <a href="./logout.php" class="logout_btn">Logout</a>
                </div>
                
                <div class="right_area">
                    <a href="./setting.php" class="setting_btn">Setting</a>
                </div>
    
                <div class="right_area">
                    <a href="./profile.php" class="profile_btn">Profile</a>
                </div>
    
            </header>
            <!--header area end-->
    
            <!--sidebar start-->
            <div class="sidebar">
                <a href="./dashboard.php"><i class="fa fa-th"></i><span>Dashboard</span></a>
                <a href="./add-category.php"><i class="fa fa-file-text"></i><span>Add Category</span></a>
                <a href="./manage-categories.php"><i class="fa fa-file-text"></i><span>Manage Category</span></a>
                <a href=""><i class="fa fa-list-alt"></i><span>Add Product</span></a>
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
                        <h2><i class="fa fa-list-alt"></i> Add Product</h2>
                    </div>
                </div>
                <div class="cardbox">
                    <form method="post">

                    <div class="form-group">
                        <div>
                            <label for="validationCustom03">Category</label>
                        </div>
                        <br>
                        <select class="select" name="category" required>
                        
                        <option disabled selected>Select category</option>
                            <?php
                                $ret=mysqli_query($con,"select CategoryName from tblcategory");
                                while($row=mysqli_fetch_array($ret))
                                {?>
                                    <option value="<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <br>
                    
                    <div class="form-group">                        
                        <div>
                            <label for="validationCustom03">Company</label>
                        </div>
                        <br>
                        <select class="select" name="category" name="company" required>
                            <option disabled selected value="">Select Company</option>
                            <?php
                                $ret=mysqli_query($con,"select CompanyName from tblcompany");
                                while($row=mysqli_fetch_array($ret))
                                {?>
                                    <option value="<?php echo $row['CompanyName'];?>"><?php echo $row['CompanyName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                
                    <br>
    
                    <div class="form-group">
                        <div class="product-label">
                            <label class="productname">Product Name</label>
                        </div>
                        <input type="text" class="input" name="productname" id="productname" placeholder="Product Name" required>
                    </div>
                    
                    <br>
                
                    <div class="form-group">
                        <div class="product-label">
                            <label class="productprice">Product Price</label>
                        </div>
                        <input type="text" class="input"  name="productprice" id="productprice" placeholder="Product Price" required>
                    </div>
                    <br>
                
                    <input type="submit" class="btn btn-lg btn-block" name="submit"  href=""></input>
                    </form>
                </div>
            </div>
        </body>
    </html>
<?php } ?>