<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Change password code
if(isset($_POST['submit']))
{
$adminid=$_SESSION['aid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$adminid'");
echo "<script>alert('Password changed successfully.');</script>";   
echo "<script>window.location.href='setting.php'</script>";
} else {
echo "<script>alert('Your current password is wrong');</script>";   
echo "<script>window.location.href='setting.php'</script>";
}



}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Change Password</title>
    <link href="./includes/style.css" rel="stylesheet" type="text/css">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
                integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
                crossorigin="anonymous">
    <!--/Font Awesome-->
    
    <style>
        .input:focus,
        .input:hover{
            outline:none;
            border:2px solid #2593b8;
        }
    </style>

    <script type="text/javascript">
        function checkpass()
        {
            if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
            {
                alert('New Password and Confirm Password field does not match');
                document.changepassword.confirmpassword.focus();
                return false;
            }
        return true;
        }   
    </script>    


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
            <a class="setting_btn" href="./setting.php">Setting</a>
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
    <div class="content">
        <!-- Main Content -->
        <div class="cardbox">
            <!-- Title -->
            <div class="card-title">
                <h2>Admin Change Password</h2>
            </div>
            <!-- /Title -->

            <div class="form-group">
                <form class="needs-validation" method="post" name="changepassword" novalidate onsubmit="return checkpass();">
                                        
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="validationCustom03">Current Password</label>
                            <div>
                            <input type="password" class="input" id="currentpassword" placeholder="Current Passsword" name="currentpassword" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="validationCustom03">New Password</label>
                            <div>
                                <input type="password" class="input" id="newpassword" placeholder="New Passsword" name="newpassword" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-10">
                            <label for="validationCustom03">Confirm Password</label>
                            <div>
                                <input type="password" class="input" id="confirmpassword" placeholder="Confirm Passsword" name="confirmpassword" required>
                            </div>
                        </div>
                    </div>
                    <br>                            
                    <button class="btn btn-primary" type="submit" name="submit">Change</button>
                </form>                 
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>