<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion   
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Manage Invoices</title>
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
        <a href="./dashboard.php"><i class="fa fa-th"></i><span>Dashboard</span></a>
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
                <h2><i class="fa fa-list-alt"></i> View Invoice</h2>
            </div>
            <form>
                <div class="form-group"> 
                    <div>
                        <h3>HP DAIRY, JALGAON</h3>
                    </div>
                    <?php 
                    //Consumer Details
                    $inid=$_SESSION['invoice'];
                    $query=mysqli_query($con,"select distinct InvoiceNumber,CustomerName,CustomerContactNo,PaymentMode,InvoiceGenDate  from tblorders  where InvoiceNumber='$inid'");
                    $cnt=1;
                    while($row=mysqli_fetch_array($query))
                    {    
                    ?>
                        <h3><b>Invoice / Receipt</b></h3>
                        <div>
                            <span><b>Date:</b><?php echo $row['InvoiceGenDate'];?></span></span>
                        </div>
                        <div>
                            <span ><b>Invoice / Receipt No:</b><span class="pl-10 text-dark"><?php echo $row['InvoiceNumber'];?></span></span>
                        </div>
                        <div>
                            <span ><b>Customer Name:</b><span class="pl-10 text-dark"><?php echo $row['CustomerName'];?></span></span>
                        </div>
                        <div>
                            <span ><b>Customer Mobile No:</b><span class="pl-10 text-dark"><?php echo $row['CustomerContactNo'];?></span></span>
                        </div>
                        <div>
                            <span ><b>Payment Mode:</b><span class="pl-10 text-dark"><?php echo $row['PaymentMode'];?></span></span>
                        </div>
                        <?php } ?>
                    <hr class="mt-0">
                                
                            
                    <table class="table mb-0" border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th >Product Name</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th width="5%">Quantity</th>
                                <th width="10%">Unit Price</th>
                                <th width="10%">Price</th>
                            </tr>
                        </thead>
                        <?php 
                        //Product Details
                        $query=mysqli_query($con,"select tblproducts.CategoryName,tblproducts.ProductName,tblproducts.CompanyName,tblproducts.ProductPrice,tblorders.Quantity  from tblorders join tblproducts on tblproducts.id=tblorders.ProductId where tblorders.InvoiceNumber='$inid'");
                        $cnt=1; 
                        while($row=mysqli_fetch_array($query))
                        {    
                            ?>                                                
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo $row['ProductName'];?></td>
                                <td><?php echo $row['CategoryName'];?></td>
                                <td><?php echo $row['CompanyName'];?></td>
                                <td><?php echo $qty=$row['Quantity'];?></td>
                                <td><?php echo $ppu=$row['ProductPrice'];?></td>
                                <td><?php echo $subtotal=number_format($ppu*$qty,2);?></td>
                            </tr>

                            <?php
                            $grandtotal+=$subtotal; 
                            $cnt++;
                            } ?>
                            <tr>
                                <th colspan="6" style="text-align:center; font-size:20px;">Total</th> 
                                <th style="text-align:left; font-size:20px;"><?php echo number_format($grandtotal,2);?></th>   
                            </tr>                                              
                    </table>
                </div>
            </from>
        </div>
    </div>
</body>
</html>
<?php } ?>