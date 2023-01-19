<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Add company Code
if(isset($_POST['update']))
{
 $adminid=$_SESSION['aid'];   
//Getting Post Values
$adminname=$_POST['adminname'];  
$emailid=$_POST['emailid'];  
$mobileno=$_POST['mobilenumber'];   
$query=mysqli_query($con,"update tbladmin set AdminName='$adminname',MobileNumber='$mobileno',Email='$emailid' where id='$adminid'"); 
if($query){
echo "<script>alert('Admin details updated successfully.');</script>";   
echo "<script>window.location.href='profile.php'</script>";
} 
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin profile</title>
    <link rel="stylesheet" type="text/css" href="./includes/style.css">


    <style>
        .input:focus,
        .input:hover{
            outline:none;
            border:2px solid #2593b8;
        }
    </style>

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
            <a href="./setting.php" class="setting_btn" href="./setting.php">Setting</a>
        </div>

        <div class="right_area">
            <a href="./profile.php" class="profile_btn">Profile</a>
        </div> 
    </header>
    <!--header area end-->

    <!--sidebar start-->
    <div class="sidebar">
        <a href="dashboard.php"><i class="fa fa-th"></i><span>Dashboard</span></a>
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

    <!-- HK Wrapper -->
	<div class="content">
        <!-- Main Content -->
        <div class="cardbox">
            <!-- Title -->
            <div class="card-title">
                <h2>Admin Profile</h2>
            </div>
            <!-- /Title -->

            <div class="form-group">
                <form class="needs-validation" method="post" novalidate>
                    <?php 
                        //Getting admin name
                        $adminid=$_SESSION['aid'];
                        $query=mysqli_query($con,"select * from tbladmin where id='$adminid'");
                        while($row=mysqli_fetch_array($query)){
                        ?>   
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03"> Reg. Date</label>
                                <?php echo $row['AdminRegdate'];?>
                            </div>
                        </div>
                        <br>
                        <?php if($row['UpdationDate']!=""){?>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03"> Last Updation Date</label>
                                <?php echo $row['UpdationDate'];?>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <div class="form-row">
                        <label for="validationCustom03"> Name</label>
                        <div>
                            <input type="text" class="input" id="validationCustom03" value="<?php echo $row['AdminName'];?>" name="adminname" required>
                        </div>
                    </div>
    
                    <br>
                    <div class="form-row">
                        <label for="validationCustom03"> Username</label>
                        <div>
                            <input type="text" class="input" id="validationCustom03" value="<?php echo $row['UserName'];?>" name="username" readonly>
                        </div>
                    </div>

                    <br>
                    <div class="form-row">
                        <label for="validationCustom03">Email id</label>
                        <div>
                            <input type="text" class="input" id="validationCustom03" value="<?php echo $row['Email'];?>" name="emailid" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <label for="validationCustom03"> Mobile Number</label>
                        <div>
                            <input type="text" class="input" id="validationCustom03" value="<?php echo $row['MobileNumber'];?>" name="mobilenumber" required>
                        </div>
                    </div>
                    <?php } ?>
                    <br>                          
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </form>
            </div>    
        </div>
    </div>
</body>
</html>
<?php } ?>